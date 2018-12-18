<?php

namespace App\Listeners;

use App\Events\ContentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Imagick;
use Intervention\Image\ImageManagerStatic as Image;

use App\Content;

class FirstPagePdfToJpeg implements ShouldQueue
{
  /**
  * Create the event listener.
  *
  * @return void
  */
  public function __construct()
  {
    //
  }

  /**
  * Handle the event.
  *
  * @param  ContentCreated  $event
  * @return void
  */
  public function handle(ContentCreated $event)
  {

    $pdf_file = $event->file;
    $pdf_file_path = storage_path($pdf_file);

    $jpeg_file = pathinfo($pdf_file_path, PATHINFO_FILENAME) . '_' . '1' . '.' . 'jpeg';
    $jpeg_file_path = storage_path($jpeg_file);

    $jpeg_file_thumbnail = pathinfo($pdf_file_path, PATHINFO_FILENAME) . '_' . 'thumbnail_' . '1' . '.' . 'jpeg';
    $jpeg_file_thumbnail_path = storage_path($jpeg_file_thumbnail);

    $png_file = pathinfo($pdf_file_path, PATHINFO_FILENAME) . '_' . '1' . '.' . 'png';
    $png_file_path = storage_path($png_file);

    try
    {
      $imagick = new  Imagick($pdf_file_path);
    }
    catch (ImagickException $e)
    {
      throw new Exception(_('Invalid or corrupted image file, please try uploading another image.'));
    }

    foreach ($imagick as $page)
    {
      $page->writeimage($png_file_path);

      $img = Image::make($png_file_path);
      $img->resize(400, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->encode('jpg');
      $img->save($jpeg_file_path, 85);

      $img = Image::make($png_file_path);
      $img->resize(180, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->encode('jpg');
      $img->save($jpeg_file_thumbnail_path, 85);

      break;
    }

    try
    {

      Storage::disk('s3')->put($pdf_file, fopen($pdf_file_path, 'r+'), 'public');
      Storage::disk('s3')->put($jpeg_file, fopen($jpeg_file_path, 'r+'), 'public');
      Storage::disk('s3')->put($jpeg_file_thumbnail, fopen($jpeg_file_thumbnail_path, 'r+'), 'public');


    }
    catch(S3 $e)
    {
      return $e->getMessage();
    }

    $imagick->destroy();

    $s3_pdf_file = Storage::disk('s3')->url($pdf_file);
    $s3_first_page = Storage::disk('s3')->url($jpeg_file);
    $s3_thumbnail = Storage::disk('s3')->url($jpeg_file_thumbnail);

    $content = Content::whereId($event->content->id);
    $content->update(
      [
        'full_file' => $s3_pdf_file,
        'first_page' => $s3_first_page,
        'thumbnail' => $s3_thumbnail
      ]
    );

    Storage::delete(
      [
        $jpeg_file_path,
        $pdf_file_path,
        $s3_thumbnail
      ]
    );
  }

  /**
  * Handle a job failure.
  *
  * @param  \App\Events\OrderShipped  $event
  * @param  \Exception  $exception
  * @return void
  */
  public function failed(ContentCreated $event, $exception)
  {
    //
  }
}

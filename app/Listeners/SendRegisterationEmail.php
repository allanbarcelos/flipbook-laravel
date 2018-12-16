<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegisterationEmail implements ShouldQueue
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
  * @param  UserCreated  $event
  * @return void
  */
  public function handle(UserCreated $event)
  {

    $user = User::find($event->userId)->toArray();

    Mail::send('emails.mailEvent', $user, function($message) use ($user) {
        $message->to($user['email']);
        $message->subject('Event Testing');
    });

    //Send Email Code Here
  }
}

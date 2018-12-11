@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('homeIndex') }}
<canvas id="the-canvas"></canvas>
@endsection


@section('scripts')
  <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
  <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

  <script>

  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
  var url = '//elasticbeanstalk-us-east-2-006536376604.s3.us-east-2.amazonaws.com/646cd6aa0037255a2ce2381c954e7194_1544482087.pdf';

  // Loaded via <script> tag, create shortcut to access PDF.js exports.
  var pdfjsLib = window['pdfjs-dist/build/pdf'];

  // The workerSrc property shall be specified.
  pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

  // Asynchronous download of PDF
  var loadingTask = pdfjsLib.getDocument(url);
  loadingTask.promise.then(function(pdf) {
    console.log('PDF loaded');

    // Fetch the first page
    var pageNumber = 1;
    pdf.getPage(pageNumber).then(function(page) {
      console.log('Page loaded');

      var scale = 1.5;
      var viewport = page.getViewport(scale);

      // Prepare canvas using PDF page dimensions
      var canvas = document.getElementById('the-canvas');
      var context = canvas.getContext('2d');
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render PDF page into canvas context
      var renderContext = {
        canvasContext: context,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);
      renderTask.then(function () {
        console.log('Page rendered');
      });
    });
  }, function (reason) {
    // PDF loading error
    console.error(reason);
  });
  </script>
@endsection

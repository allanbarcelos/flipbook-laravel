@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('homeIndex') }}

<div id="holder"></div>

@endsection


@section('scripts')
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="//cdn.jsdelivr.net/turn.js/3/turn.min.js"></script>

<script type="text/javascript">
function renderPDF(url, canvasContainer, options)
{
  var options = options || { scale: 1 };
  var pdfjsLib = window['pdfjs-dist/build/pdf'];
  function renderPage(page)
  {
    var viewport = page.getViewport(options.scale);
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };

    canvas.height = viewport.height;
    canvas.width = viewport.width;
    canvasContainer.appendChild(canvas);

    page.render(renderContext);
  }

  function renderPages(pdfDoc)
  {
    for(var num = 1; num <= pdfDoc.numPages; num++)
    pdfDoc.getPage(num).then(renderPage);
  }
  pdfjsLib.disableWorker = true;
  pdfjsLib.getDocument(url).then(renderPages);
}
</script>

<script type="text/javascript">
renderPDF('/curriculo.pdf', document.getElementById('holder'));



$(window).ready(function() {
  $('#holder').turn({
    display: 'double',
    acceleration: true,
    gradients: !$.isTouch,
    elevation:50,
    when: {
      turned: function(e, page) {
        console.log('Current view: ', $(this).turn('view'));
      }
    }
  });
});

$(window).bind('keydown', function(e){
  if (e.keyCode==37)
  $('#holder').turn('previous');
  else if (e.keyCode==39)
  $('#holder').turn('next');
});
</script>
@endsection

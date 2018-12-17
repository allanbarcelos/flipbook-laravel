@extends('layouts.app')

@section('content')

<div id="the-canvas"></div>


@endsection


@section('scripts')
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="//cdn.jsdelivr.net/turn.js/3/turn.min.js"></script>

<script type="text/javascript">

    $(function(){

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
            $('#the-canvas').append(canvas);

            page.render(renderContext);
            //$("#the-canvas > canvas:nth-child(1)").hide();
        }

        function renderPages(pdfDoc)
        {
            var arr = [];

            for(var num = 1; num <= pdfDoc.numPages; num++)
              arr[num] = pdfDoc.getPage(num).then(renderPage);

            Promise.all(arr)
            .then(
                function () {
                    $('#the-canvas').turn({
                        display: 'double',
                        acceleration: true,
                        gradients: !$.isTouch,
                        elevation:50,
                        width:$("#the-canvas > canvas").height(),
                        height:$("#the-canvas > canvas").height(),
                        when: {
                            turned: function(e, page) {
                                console.log('Current view: ', $(this).turn('view'));
                            }
                        }
                    });
                }
            );
        }


        pdfjsLib.disableWorker = true;
        pdfjsLib.getDocument('//elasticbeanstalk-us-east-2-006536376604.s3.us-east-2.amazonaws.com/4cf9c03e5fdbbbb13c95c71b12715801_1545037310.pdf').then(renderPages);

    });


</script>

<script type="text/javascript">
console.log("ok");


/*
$(window).ready(function () {
$('#the-canvas').turn({
display: 'double',
acceleration: true,
gradients: !$.isTouch,
elevation:50,
width: 400,
height: 300,
when: {
turned: function(e, page) {
console.log('Current view: ', $(this).turn('view'));
}
}
});
})
$(window).bind('keydown', function(e){
if (e.keyCode==37)
$('#the-canvas').turn('previous');
else if (e.keyCode==39)
$('#the-canvas').turn('next');
});*/
</script>
@endsection

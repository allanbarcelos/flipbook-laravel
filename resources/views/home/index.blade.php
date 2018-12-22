@extends('layouts.app')

@section('content')


    @if(isset($lastEdition))
    <div class="row">

        <div class="col-md-7">
            <br />
            <h3>Última edição <small>{{$lastEdition->edition_date->format('d/m/Y')}}</small></h3>
            <hr />
            <div id="the-canvas">
                <img data-src="{{ $lastEdition->first_page }}" alt="" class="lazy img-thumbnail offset-md-2">
            </div>
            <br />
            <div class="row">
                <div class="col-md-8">
                    <a href="{{route('news_read', $edition_date ) }}" class="btn btn-lg btn-block btn-success offset-md-3">Ler Agora</a>
                </div>
            </div>
        </div>

        <div class="col-md-5 bg-secondary">
            <h3 class="text-center"><i class="fa fa-chevron-up"></i></h3>
            <hr />
            @if(empty($monthEditions))
            <h4 class="text-center">Não há edições esse mês</h4>
            @endif
            <?php $i = 0; foreach ($monthEditions as $value): ?>
            <?php if($i == 0){ ?>
                <div class="row">
                <?php } ?>
                <?php

                $edition_date = explode("-", $value->edition_date->format('Y-m-d') );
                $edition_date = [
                    "year" => $edition_date[0],
                    "month" => $edition_date[1],
                    "day" => $edition_date[2]
                ];

                ?>
                <div class="col-md-5 @if($i == 0) offset-md-1 @endif text-center">
                    <a href="{{ route('home_edition',$edition_date) }}">
                        <img data-src="{{$value->thumbnail}}" class="img-fluid img-thumbnail prev lazy" alt="{{$value->edition_date}}">
                    </a>
                </div>

                <?php if($i == 1){ ?>
                </div>
                <br />
            <?php } ?>

            <?php $i = ($i == 1) ? 0 : $i + 1; endforeach; ?>
            <div class="row">&nbsp;</div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Nenhuma edição publicada ainda</h2>
        </div>
    </div>
    @endif

@endsection


@section('scripts')

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.plugins.min.js"></script>

    <script type="text/javascript">
        $(function($) {
            $("img.lazy").Lazy({
              effect: "fadeIn",
              effectTime: 500,
              threshold: 0
            });
        });

        $('.carousel .vertical .item').each(function(){
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i=1;i<2;i++) {
                next=next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

    </script>
@endsection

@extends('learn')

@section('html-page-title')
    FIMBO.RU - УЧИСЬ
@overwrite

@section('lections')
    @if($lection->type == 'comics')
        @include('comics')
    @else

        <?php
        $agent = new Jenssegers\Agent\Agent();
        $mobile = $agent->isMobile();
        ?>

        @if($mobile)
            <script src="<?=asset('js/libs/jquery.mobile-1.4.5.min.js')?>"></script>
            <script>
                window.sliderLectionsSettings = {
                    items: 1,
                    loop:false,
                    nav:false,
                    dots: false,
                    autoplay:false,
                };
                $(function(){
                    $(".read-bg_comics").on("tap",function(){
                        $('.js-comics-close').toggle();
                    });

                });
            </script>
        @endif

    <div class="read-bg js-read-comics read-bg_comics">
        <div class="read-comics <?=$mobile?'':'read-comics_lection'?> <?=$mobile?' mobile':''?>">
            <a href="javascript:void(0);" class="popup__close js-comics-close<?=$mobile?' mobile':''?>"></a>
            <div class="read-task__title<?=$mobile?' mobile':''?>">{{ $lection->course->title }}</div>
            <div class="read-task__dop-title<?=$mobile?' mobile':''?>">Лекция {{ $lection->number }} из {{ App\Page::whereType('lection')->whereParentId(null)->count() }}. {{ $lection->title }}</div>
            <div class="js-read-lection-slider">

                <?php $i = 0;?>
                @foreach($lection->children as $page)
                        <?php $i++;?>
                <div class="item" data-number="{{ $page->number }}">
                    <div class="item text contentContainer" id="item{{ $i }}">
                        <script>
                            $(function(){
                                var content = JSON.parse('{!! json_encode( str_replace( "\0", "\\u0000", addcslashes( $page->content, "\t\r\n\"\\" ) ) ) !!}');

                                if( $(content).text()=='' &&  $(content).find('img').length==1 ) {
                                    $img = $(content).children('img');
                                    $img.removeAttr('width');
                                    $img.removeAttr('height');
                                    $('#item{{ $i }}').html($img);
                                    $('#item{{ $i }}').removeClass('text')
                                } else {
                                    $('#item{{ $i }}').html(content);
                                }
                            });

                        </script>
                    </div>
                </div>
                @endforeach
<script>
    for(c in o = document.getElementsByClassName('contentContainer')) {
        if(typeof o[c].tagName != 'undefined') {
            for(i in oo = o[c].getElementsByTagName('img')) {
                if(typeof oo[i].tagName != 'undefined') {
                    if(typeof(src = oo[i].getAttribute('src')) != 'undefined') {
                        var img = new Image();
                        img.src = src;
                        console.log(img);
                    }
                }
            }
        }
    }
</script>
            </div>
        </div>
    </div>
    <input type="hidden" name="lectionId" id="lectionId" value="{{ $lectionId }}">
<script>
    @if($mobile)
window.setPageSelected = function() {};
    @else
window.setPageSelected = function() {
    if({{ $pageNum or false }}) {
        var sequenceNum = $('.owl-item:not(.cloned) > div.item').index($('.owl-item:not(.cloned) > div.item[data-number="{{ $pageNum }}"'))
        $('.js-read-lection-slider').data('owl.carousel').to(sequenceNum);
    }
};
    @endif
</script>
    @endif
@endsection
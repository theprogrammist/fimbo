<?php
$agent = new Jenssegers\Agent\Agent();
$mobile = $agent->isMobile();
?>

@if($mobile)
    <script src="<?=asset('js/libs/jquery.mobile-1.4.5.min.js')?>"></script>
    <script>
        window.sliderComicsSettings = {
            items: 2,
            margin: 10,
            slideBy: 2,
            loop:false,
            nav:false,
            dots: false,
            autoplay:false,
            //dotsEach: true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                768:{
                    items:2,
                },
                1000:{
                    items:2,
                }
            }
        };
$(function(){
    $(".read-bg_comics").on("tap",function(){
        $('.js-comics-close').toggle();
    });

});
    </script>
@endif

    <div class="read-bg js-read-comics read-bg_comics">
        <div class="read-comics<?=$mobile?' mobile':''?>">
            <a href="javascript:void(0);" class="popup__close js-comics-close<?=$mobile?' mobile':''?>"></a>
            <div class="read-task__title<?=$mobile?' mobile':''?>">{{ $lection->course->title }}</div>
            <div class="read-task__dop-title<?=$mobile?' mobile':''?>">Лекция-комикс {{ $lection->number }} из {{ App\Page::whereType('comics')->whereParentId(null)->count() }}. {{ $lection->title }}</div>
            <div class="js-read-comics-slider">

                @foreach($lection->children as $page)
                    <div class="item" data-number="{{ $page->number }}">
                        <img src="{{ url('images/' . $page->l_img) }}" alt="comics">
                    </div>
                    <div>
                        <img src="{{ url('images/' . $page->r_img) }}" alt="comics">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <input type="hidden" name="lectionId" id="lectionId" value="{{ $lectionId }}">
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
<script>
    @if($mobile)
window.setPageSelected = function() {};
    @else
window.setPageSelected = function() {
    if({{ $pageNum or false }}) {
        var sequenceNum = $('.owl-item:not(.cloned) > div.item').index($('.owl-item:not(.cloned) > div.item[data-number="{{ $pageNum }}"'))
        $('.js-read-comics-slider').data('owl.carousel').to(sequenceNum);
    }
};
    @endif
</script>
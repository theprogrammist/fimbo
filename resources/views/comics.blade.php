    <div class="read-bg js-read-comics read-bg_comics">
        <div class="read-comics">
            <a href="javascript:void(0);" class="popup__close js-comics-close"></a>
            <div class="read-task__title">{{ $lection->course->title }}</div>
            <div class="read-task__dop-title">Лекция-комикс {{ $lection->number }} из {{ App\Page::whereType('comics')->whereParentId(null)->count() }}. {{ $lection->title }}</div>
            <div class="js-read-comics-slider">

                @foreach($lection->children as $page)
                    <div class="item" data-number="{{ $page->number }}">
                        <img src="{{ url('images/' . $page->l_img) }}" alt="comics">
                    </div>
                    <div class="item">
                        <img src="{{ url('images/' . $page->r_img) }}" alt="comics">
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
window.setPageSelected = function() {
    if({{ $pageNum or false }}) {
        var sequenceNum = $('.owl-item:not(.cloned) > div.item').index($('.owl-item:not(.cloned) > div.item[data-number="{{ $pageNum }}"'))
        $('.js-read-lection-slider').data('owl.carousel').to(sequenceNum);
    }
};
</script>
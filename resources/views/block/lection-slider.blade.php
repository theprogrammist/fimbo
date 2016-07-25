@foreach($course->lections as $lct)
    <?php $i++;?>
    <div class="slider__item">
        <div class="slider__item-block">
            <div class="slider__item-image">
                <img src="/img/slider-decide-img3.jpg" alt="slider-img" class="slider__item-img">
            </div>
            <a href="javascript:void(0);" onclick="rememberVisitedPosition(this,'{{ url('lection/') . '/' . $lct->id . '/'  }}');">
                <div class="slider__item-title">
                    <div class="slider__item-lection">Лекция<?=($lct->type=='comics') ? '-комикс' : ''?> {{ $lct->number }}</div>
                    <div class="slider__item-span">{{$lct->title}}</div>
                </div>
            </a>

            <div class="slider__item-level {{ (empty($lct->difficulty))?App\Page::$difficultyColors[1] : App\Page::$difficultyColors[$lct->difficulty] }}Option">
                {{ (empty($lct->difficulty))?App\Page::$difficultyNames[1] : App\Page::$difficultyNames[$lct->difficulty] }}</div>
        </div>
        <div class="slider__item-text">
            <div class="slider__item-text-hidden">
                {!! $lct->content !!}
            </div>
        </div>
    </div>
@endforeach
@section('left-menu')
<ul class="nav nav-sidebar">
    <li class="<?=Request::segment(2)===null ? 'active':''?>">
        <a href="{{ url('admin') }}">
            Статистика <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="<?=Request::segment(2)==='static-content' ? 'active':''?>">
        <a href="{{ route('staticContent', ['name'=>'main']) }}" data-toggle="collapse" data-target="#SubMenu1">
            Статический контент
        </a>
        <ul id="SubMenu1" class="nav list-group-submenu collapse <?=Request::segment(2)==='static-content' ? 'in':''?>">
            <li class="<?=Request::segment(3)==='main' ? 'active':''?>"><a href="{{ route('staticContent', ['name'=>'main']) }}">Главная</a></li>
            <li class="<?=Request::segment(3)==='about_us' ? 'active':''?>"><a href="{{ route('staticContent', ['name'=>'about_us']) }}">О нас</a></li>
            <li class="<?=Request::segment(3)==='rules' ? 'active':''?>"><a href="{{ route('staticContent', ['name'=>'rules']) }}">Правила</a></li>
            <li class="<?=Request::segment(3)==='agreement' ? 'active':''?>"><a href="{{ route('staticContent', ['name'=>'agreement']) }}">Пользовательское соглашение</a></li>
        </ul>
    </li>
    <li class="course <?=Request::segment(2)==='course' ? 'active':''?>">
        <a href="{{ url('admin/course/new') }}" data-toggle="collapse" data-target="#courses">
            Предметы<span style="display: inline-block;float: right;">+</span>
        </a>
        @foreach(App\Course::all() as $cs)
            <ul id="courses" class="nav list-group-submenu collapse <?=Request::segment(2)==='course' ? 'in':''?>">
                <li class="<?=Request::segment(3) == $cs->id ? 'active':''?>">
                    <a href="{{ url('admin/course/' . $cs->id) }}">
                        {{$cs->title}}
                    </a>
                </li>
            </ul>
        @endforeach
    </li>

    <li class="lections <?=Request::segment(2)==='lection' ? 'active':''?>">
        <a href="{{ url('admin/lection/new') }}">
            Лекции<span style="display: inline-block;float: right;">+</span>
        </a>
        @foreach(App\Page::whereType('lection')->whereParentId(null)->get() as $pg)
            <ul>
                <li>
                    <a href="{{ url('admin/lection/' . $pg->id) }}" class="<?=Request::segment(3) == $pg->id ? 'active':''?>">
                        {{$pg->title}}

                        @foreach($pg->children as $chld)
                            <ul>
                                <li>
                                    <a href="{{ url('admin/lection/' . $chld->id) }}" class="<?=Request::segment(3) == $chld->id ? 'active':''?>">Страница&nbsp;{{$chld->number}}</a>
                                </li>
                            </ul>
                        @endforeach

                    </a>
                </li>
            </ul>
        @endforeach
    </li>


    <li class="lections <?=Request::segment(2)==='comics' ? 'active':''?>">
        <a href="{{ url('admin/comics/new') }}">
            Лекции-Комиксы<span style="display: inline-block;float: right;">+</span>
        </a>
        @foreach(App\Page::whereType('comics')->whereParentId(null)->get() as $pg)
            <ul>
                <li>
                    <a href="{{ url('admin/comics/' . $pg->id) }}" class="<?=Request::segment(3) == $pg->id ? 'active':''?>">
                        {{$pg->title}}

                        @foreach($pg->children as $chld)
                            <ul>
                                <li>
                                    <a href="{{ url('admin/comics/' . $chld->id) }}" class="<?=Request::segment(3) == $chld->id ? 'active':''?>">Страница&nbsp;{{$chld->number}}</a>
                                </li>
                            </ul>
                        @endforeach

                    </a>
                </li>
            </ul>
        @endforeach
    </li>



</ul>


@endsection
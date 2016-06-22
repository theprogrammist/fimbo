@section('left-menu')
<ul class="nav nav-sidebar">
    <li class="<?=Request::segment(2)===null ? 'active':''?>"><a href="{{ url('admin') }}">Пульс <span class="sr-only">(current)</span></a></li>
    <li class="<?=Request::segment(2)==='static-content' ? 'active':''?>"><a href="{{ route('staticContent') }}">Статический контент</a></li>
</ul>
<!--ul class="nav nav-sidebar">
    <li><a href="">Nav item</a></li>
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
    <li><a href="">More navigation</a></li>
</ul>
<ul class="nav nav-sidebar">
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
</ul-->
@endsection
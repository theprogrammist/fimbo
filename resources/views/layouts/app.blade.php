@extends('layouts.app-thin')

@section('app')
<div class="screen1 screen1_inner">
    <div class="container">
        <div class="header header_inner">

            @if(Request::is('register') || Request::is('register/success') /*|| Request::is('register/verify*')*/)
                <a href="{{ url('/') }}" class="logo">
                    <img src="<?=asset('img/logo.png')?>" alt="logo">
                </a>
            @else

            @include('layouts.top')

            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="content">

        @yield('content')


    </div>
</div>
@endsection
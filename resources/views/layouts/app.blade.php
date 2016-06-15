@extends('layouts.app-thin')

@section('app')
<div class="screen1 screen1_inner">
    <div class="container">
        <div class="header header_inner">

            @include('layouts.top')

        </div>
    </div>
</div>
<div class="container">
    <div class="content">

        @yield('content')


    </div>
</div>
@endsection
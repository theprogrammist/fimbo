@extends('layouts.admin.main')

@if(Request::is('admin/static-content/main'))

    @include('admin.static-content-main')

@else


@section('content')
    @include('admin.block.content-form')
@endsection


@endif
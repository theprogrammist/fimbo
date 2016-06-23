@extends('layouts.app')

@section('html-page-title')
    {{  $page->title  }}
@overwrite

@section('content')
    {!! $page->content !!}
@endsection
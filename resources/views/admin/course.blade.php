@extends('layouts.admin.main')

@section('content')
    @if (($message = Session::get('error')) || ($message[] = $errors->first('name')))
        <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Ошибка</h4>
                    @if(is_array($message))
                        @foreach ($message as $m)
                            {{ $m }}
                        @endforeach
                    @else
                        {{ $message }}
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if ($message = Session::get('message'))
        <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Готово</h4>
                    @if(is_array($message))
                        @foreach ($message as $m)
                            {{ $m }}
                        @endforeach
                    @else
                        {{ $message }}
                    @endif
                </div>
            </div>
        </div>
    @endif

    {!! Form::open(
        array(
            'url' => url(Request::url() . "/save"),
            'class' => 'form-horizontal',
            'files' => true)) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="course_id" value="@if(!old('course_id')){{$course->id}}@endif{{ old('course_id') }}">

    @if (Request::segment(2)==='course' && Request::segment(3)==='new')
        <h3>Новый предмет</h3>
    @endif

    @include('admin.block.plain-text', ['page' => $course, 'name' =>'title', 'caption' => 'Название', 'inputText' => 'true'])
    @include('admin.block.plain-text', ['page' => $course, 'name' =>'description', 'caption' => 'Описание'])


    <div class="form-group col-sm-9">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-success col-sm-offset-1']) !!}
        @if(!empty($course->id))
            <a href="{{  url(Request::url() . '/delete/?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
        @endif
    </div>



@endsection
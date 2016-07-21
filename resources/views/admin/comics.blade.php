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
    <input type="hidden" name="page_id" value="@if(!old('page_id')){{$page->id}}@endif{{ old('page_id') }}">

    @if (Request::segment(3)==='new')
        <h3>Новая лекция-комикс</h3>
    @endif
    @if(Request::segment(3)==='newpage')
        <h3>Новый разворот лекции-комикса <a href="{{ url('admin/comics/' . $id) }}">{{ App\Page::find($id)->title }}</a></h3>
        <input type="hidden" name="parent_id" value="{{ $id }}"/>
    @endif

    @if ( (Request::segment(3)==='new') || (is_numeric(Request::segment(3)) && empty($page->parent_id)) )
        @include('admin.block.course_id-select')
    @endif

    @include('admin.block.plain-text',
           ['name' =>'number',
            'caption' => 'Номер' . (( (Request::segment(3)==='newpage') || !empty($page->parent_id) ) ? ' страницы' : ''),
             'inputText' => 'true',
             'default' => App\Page::whereParentId($id)->max('number')+1])

    @if ( (Request::segment(3)==='new') || (is_numeric(Request::segment(3)) && empty($page->parent_id)) )
    @include('admin.block.plain-text', ['name' =>'title', 'caption' => 'Название', 'inputText' => 'true'])
    @include('admin.block.difficulty-form-el')
    @include('admin.block.plain-text', ['name' =>'content', 'caption' => 'Описание'])
    @endif


    @if ( (Request::segment(3)==='newpage') || !empty($page->parent_id) )
        @foreach(['l_img','r_img'] as $img)
    <div class="col-sm-9 form-group" style="border: 1px solid rgba(0,0,0,0.1); padding: 5px; border-radius: 25px;">
        <label class="col-sm-3 control-label text-right">
            Картинка @if($img == 'l_img') слева @else справа @endif
        </label>
        @if($page->$img)
            <div class="form-group {{ $errors->has($img) ? ' has-error' : '' }}">
                <div class="col-sm-6">
                    <input type="hidden" name="{{ $img }}" value="{{  $page->$img  }}">
                    <img height="100" src="{{  url('/images/'.$page->$img)  }}"/>
                    <a target="_blank" href="{{  url('/images/'.$page->$img)  }}">открыть в новом окне</a>
                </div>
                <button type="button" class="btn btn-default text-right" onclick="removeUploadedFile(this)"
                        title="удалить">&ndash;</button>
            </div>
        @endif
        <div class="form-group {{ $errors->has($img) ? ' has-error' : '' }}">
            <div class="col-sm-12" style="padding-left: 5px">
                @if($page->$img)
                    <label class="col-sm-4 control-label text-right" style="margin-top: -8px">
                        Заменить файл
                    </label>
                @endif
                <div class="col-sm-5 @if(!$page->$img) col-sm-offset-4 @endif">
                    {!! Form::file($img.'_new', null) !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
        @endif

    <div class="form-group col-sm-9">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-success col-sm-offset-1']) !!}
        @if(!empty($course->id))
            <a href="{{  url(Request::url() . '/delete/?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
        @endif

        @if(is_numeric(Request::segment(3)))
            <a href="{{  url(Request::url() . '/delete/?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
        @endif

        @if(!(Request::segment(3)==='new') && !(Request::segment(3)==='newpage') )
            <a class="btn btn-info" title="добавить новый разворот в эту лекцию-комикс"
               href="{{ url('admin/comics/newpage/' . (($page->id > 0 && $page->parent === null) ? $page->id : $page->parent->id)) }}">Добавить разворот</a>
        @endif
    </div>


@endsection
@section('content')
    <?php $page->contentHash = $page->content ? json_decode($page->content) : (object) App\Page::$fields;?>

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

    <script>
        function duplicate(t) {
            $obj = $(t).parent();
            $new = $obj.clone();
            $(t).remove();
            $obj.after($new);
        }
    </script>

    {!! Form::open(
        array(
            //'route' => route('staticContent', ['name'=>'main']) . "/save/",
            'url' => url(Request::url() . "/save"),
            'class' => 'form-horizontal',
            'files' => true)) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="page_id" value="@if(!old('page_id')){{$page->id}}@endif{{ old('page_id') }}">

    @foreach (array_slice(App\Page::$fields,0,5) as $k => $v)
        @include('admin.block.plain-text', ['name' =>$k, 'caption' => $v])
    @endforeach

    <label class="col-sm-8 col-sm-offset-1">
        Баннеры блока "изучай..."
    </label>
    <div class="form-group {{ $errors->has('learnbanner[]') ? ' has-error' : '' }}">
        <div class="col-sm-10">
            <div class="col-sm-8 col-sm-offset-3">
                {!! Form::file('learnbanner[]', null) !!}
            </div>
            <button type="button" class="btn btn-default text-right" onclick="duplicate(this)">+</button>
        </div>
    </div>

    @foreach (array_slice(App\Page::$fields,5,2) as $k => $v)
        @include('admin.block.plain-text', ['name' =>$k, 'caption' => $v])
    @endforeach

    <label class="col-sm-8 col-sm-offset-1">
        Баннеры блока "решай..."
    </label>
    <div class="form-group {{ $errors->has('solvebanner[]') ? ' has-error' : '' }}">
        <div class="col-sm-10">
            <div class="col-sm-8 col-sm-offset-3">
                {!! Form::file('solvebanner[]', null) !!}
            </div>
            <button type="button" class="btn btn-default" onclick="duplicate(this)">+</button>
        </div>
    </div>

    @foreach (array_slice(App\Page::$fields,7) as $k => $v)
        @include('admin.block.plain-text', ['name' =>$k, 'caption' => $v])
    @endforeach

    <div class="form-group">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-success col-sm-offset-1']) !!}
    </div>

    {!! Form::close() !!}

@endsection
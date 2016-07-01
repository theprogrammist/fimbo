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

@if(Request::segment(2)==='lection' && (Request::segment(3)==='new' || ($page->id > 0 && $page->parent === null)))
@else
<script type="text/javascript" src="{{ asset('/js/libs/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        extended_valid_elements: "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
        file_browser_callback: function (field_name, url, type, win) {
            if (type == 'image') {
                console.log(field_name, url, type, win);
                $('#upload_form input').click();
            }
        }
    });
</script>
@endif

<iframe id="form_target" name="form_target" style="display:none"></iframe>

<form id="upload_form" action="/upload" target="form_target" method="post" enctype="multipart/form-data"
      style="width:0px;height:0;overflow:hidden">
    <input name="image" type="file"
           onchange="$('#upload_form').ajaxSubmit({ success: function(d){eval(d);} });this.value='';"></form>

<form method="post" action='{{ url(Request::url() . "/save") }}'>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="page_id" value="@if(!old('page_id')){{$page->id}}@endif{{ old('page_id') }}">

    @if (Request::segment(2)==='lection' && Request::segment(3)==='new')
        <h3>Новая лекция</h3>
    @endif

@if(!(Request::segment(2)==='lection' && Request::segment(3)==='newpage'))
    @yield('lection-fields')
@endif

@if(Request::segment(2)==='lection' && Request::segment(3)==='newpage')
    <h3>Новая cтраница лекции <a href="{{ url('admin/lection/' . $id) }}">{{ App\Page::find($id)->title }}</a></h3>
    <input type="hidden" name="parent_id" value="{{ $id }}"/>
@endif

@if(!($page->type == 'lection') || $page->parent)
@if(!(Request::segment(2)==='lection' && Request::segment(3)==='new'))
    <div class="row" style="height: 32px;">
        @if (trim($__env->yieldContent('parent-selector')))
            @yield('parent-selector')
            <?php $width = 'col-sm-8 ';?>
        @endif

        <div class="{{ $width or '' }}form-group <?=(Request::segment(2)==='lection')?' col-sm-11 ':''?> {{ $errors->has('title') ? ' has-error' : '' }}"
             style="padding-right: 0px;">
            @if(!Request::segment(2)==='lection')
                <input required="required" placeholder="Заголовок страницы (title)" type="text" name="title"
                       class="form-control" value="@if(!old('title')){{$page->title}}@endif{{ old('title') }}"/>
                @if ($errors->has('title'))
                    <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                @endif
            @endif
        </div>
            @if(Request::segment(2)==='lection')
                <?php $name = 'number'; $caption = 'Номер страницы  &nbsp; '; ?>
                <div class="{{ $errors->has($name) ? ' has-error' : '' }}" style="position: relative;top: -25px;">

                    <div class="col-sm-3" style="padding-right: 0;float: right">
                        <label class="control-label text-right" style="display: inline">
                            {{ $caption  }}
                        </label>
                        <input type="text" name="{{$name}}" class="form-control"  style="width: 100px;display: inline-block;"
                               value="@if(!old($name)){{$page->$name}}@endif{{ old($name) }}"/>
                    </div>
                    @if ($errors->has($name))
                        <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                    @endif
                </div>
            @endif
    </div>
@endif
@endif
    <div class="row">
        <div class="form-group  {{ $errors->has('content') ? ' has-error' : '' }}">
                <textarea name='content' class="form-control" rows="20">@if(!old('content')){!! $page->content !!}@endif{!! old('content') !!}</textarea>

            @if ($errors->has('content'))
                <span class="help-block">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
            @endif
        </div>
    </div>

    <input type="submit" name='publish' class="btn btn-success" value="Сохранить"/>
    @if (Request::segment(2)==='lection' && is_numeric(Request::segment(3)))
        <a href="{{  url(Request::url() . '/delete/?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
    @elseif(Request::segment(2)==='lection' && Request::segment(3)==='new')
    @elseif(Request::segment(2)==='lection' && Request::segment(3)==='newpage')
    @else
        <a href="{{  url(Request::url() . '/delete/'.$page->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
    @endif
</form>
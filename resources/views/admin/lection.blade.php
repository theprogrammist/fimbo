@extends('layouts.admin.main')

@section('child-selector')
    <div class="col-sm-11 {{ $errors->has('parent_id') ? ' has-error' : '' }}" style="margin-top: -20px;">
        <label>Страницы</label>
        <select data-name="parent_id"></select>

        @if ($errors->has('parent_id'))
            <span class="help-block">
                <strong>{{ $errors->first('parent_id') }}</strong>
            </span>
        @endif

    </div>
    <script>
        function pageEdit() {
            if($('select[data-name="parent_id"]').select2('val')) {
                console.log("{{ url('admin/lection') }}/" + $('select[data-name="parent_id"]').select2('val'));
                window.location.href = "{{ url('admin/lection') }}/" + $('select[data-name="parent_id"]').select2('val');
            }
        }
    </script>
    <a class="col-sm-1 btn btn-info" title="перейти к редактированию страницы" onclick="pageEdit()" style="margin-top: 5px;">&gt;&gt;</a>
    <style>
        .select2-chosen span[class*="icon-"] {
            vertical-align: sub;
            padding-right: 5px;
        }
        .select2-selection__clear {
            color: rgba(0,0,0,0);
            width: 20px;
            height: 20px;
            position: absolute;
            right: 1px;
            top: 4px;
            outline: none;
            background: url(/img/select2.png) right top no-repeat;
            background-size: 95px;
        }
    </style>

    <script type="text/javascript">
        var data = <?php echo json_encode(App\Page::whereType('lection')->whereParentId($page->id)->select('id','title as text')->get());?>;
        $('select[data-name="parent_id"]').select2({
            data:data,
            placeholder: "Страницы",
            allowClear: true,
            width: "100%",
            //minimumResultsForSearch: "-1",
            language: "ru",
            closeOnSelect: true,
            id: null, // {{$page->parent_id or 'null'}},
            escapeMarkup: function (m) {
                return m;
            }
        }).on('select2:unselecting', function() {
            $(this).data('unselecting', true);
        }).on('select2:opening', function(e) {
            if ($(this).data('unselecting')) {
                $(this).removeData('unselecting');
                e.preventDefault();
            }
        });

        //$('select[data-name="parent_id"]').val({{ $page->parent_id or 'null' }}).trigger('change.select2');
        $('select[data-name="parent_id"]').val(null).trigger('change.select2');
    </script>
@endsection





@section('lection-fields')
    @if($page->parent)

        <h4>Страница лекции <a href="{{ url('admin/lection/' . $page->parent->id) }}">{{ $page->parent->title }}</a></h4>

    @else

        <div class="lection-fields" style="margin: 2px -30px 50px -15px; padding-bottom: 35px;">

            <?php $name = 'course'; $caption = 'Предмет'; ?>
            <div class="{{ $errors->has($name) ? ' has-error' : '' }}">
                <label class="col-sm-1 control-label text-right">
                    {{ $caption  }}
                </label>

                <div class="col-sm-4">
                    <input type="text" name="{{$name}}" class="form-control"
                           value="@if(!old($name)){{$page->$name}}@endif{{ old($name) }}"/>
                </div>
                @if ($errors->has($name))
                    <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                @endif
            </div>

            <?php $name = 'number'; $caption = 'Номер'; ?>
            <div class="{{ $errors->has($name) ? ' has-error' : '' }}">
                <label class="col-sm-1 control-label text-right">
                    {{ $caption  }}
                </label>

                <div class="col-sm-1">
                    <input type="text" name="{{$name}}" class="form-control"
                           value="@if(!old($name)){{$page->$name}}@endif{{ old($name) }}"/>
                </div>
                @if ($errors->has($name))
                    <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                @endif
            </div>


            <div class="col-sm-5" style="height:36px;">
                @if(!(Request::segment(3)==='new'))
                    @yield('child-selector')
                    <a class="btn btn-info" title="добавить новую страницу в эту лекцию" style="margin-left: 15px;"
                       href="{{ url('admin/lection/newpage/' . $page->id) }}">добавить</a>
                @endif
            </div>


            <?php $name = 'title'; $caption = 'Название'; ?>
            <div class="{{ $errors->has($name) ? ' has-error' : '' }}">
                <label class="col-sm-1 control-label text-right">
                    {{ $caption  }}
                </label>

                <div class="col-sm-4">
                    <input type="text" name="{{$name}}" class="form-control"
                           value="@if(!old($name)){{$page->$name}}@endif{{ old($name) }}"/>
                </div>
                @if ($errors->has($name))
                    <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                @endif
            </div>


            <?php $name = 'difficulty'; $caption = 'Сложность'; ?>
            <div class="{{ $errors->has($name) ? ' has-error' : '' }}">
                <label class="col-sm-1 control-label text-right">
                    {{ $caption  }}
                </label>

                <div class="col-sm-1">
                    <select class="form-control" name="{{$name}}" style="padding-left: 2px;padding-right: 0;width: 89px;">
                        <option value="1" <?= (empty(old($name)) ? $page->$name : old($name)) == 1 ? 'selected' : '' ?>>
                            {{ App\Page::$difficultyNames[1] }}
                        </option>
                        <option value="2" <?= (empty(old($name)) ? $page->$name : old($name)) == 2 ? 'selected' : '' ?>>
                            {{ App\Page::$difficultyNames[2] }}
                        </option>
                        <option value="3" <?= (empty(old($name)) ? $page->$name : old($name)) == 3 ? 'selected' : '' ?>>
                            {{ App\Page::$difficultyNames[3] }}
                        </option>
                        <option value="4" <?= (empty(old($name)) ? $page->$name : old($name)) == 4 ? 'selected' : '' ?>>
                            {{ App\Page::$difficultyNames[4] }}
                        </option>
                    </select>
                </div>
                @if ($errors->has($name))
                    <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                @endif
            </div>
        </div>

    @endif
@endsection





@section('content')
    @include('admin.block.content-form')
@endsection

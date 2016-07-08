@extends('layouts.admin.main')

@section('child-selector')
    <div class="col-sm9 {{ $errors->has('parent_id') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label text-right">Страницы</label>
        <div class="col-sm-5">
        <select data-name="parent_id" class="form-control" style="height: 34px"></select>
        </div>
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
    <a class="col-sm-1 btn btn-info" title="перейти к редактированию страницы" onclick="pageEdit()" style="margin-top: -5px;">&gt;&gt;</a>
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

        <div class="lection-fields col-sm-9">

            <?php $name = 'course_id'; $caption = 'Предмет'; ?>
            <div class="col-sm-9 form-group">
                <label class="col-sm-3 control-label text-right">
                    {{ $caption  }}
                </label>

                <div class="col-sm-6">
                    <select class="form-control" name="{{$name}}">
                        @foreach(App\Course::all()->keyBy('id') as $course_id => $row)
                            <?php $title = $row['title'];?>
                            <option data-color="{{ $row['color'] }}" class="{{ $row['color'] }}Option" value="{{ $course_id }}"
                            <?= (empty(old($name)) ? $page->$name : old($name)) == $course_id ? 'selected' : '' ?>>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has($name))
                    <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                @endif
            </div>
            <script>
                function setSelectColor() {
                    $("select[name='{{ $name }}']").removeClass('redOption greenOption blueOption purpleOption orangeOption yellowOption');
                    $("select[name='{{ $name }}']").addClass($("select[name='{{ $name }}'] option:selected").attr('data-color') + 'Option');
                }
                $(function(){
                    setSelectColor();
                    $("select[name='{{ $name }}']").change(function(){setSelectColor();});
                });
            </script>
            @include('admin.block.plain-text', ['name' =>'number', 'caption' => 'Номер', 'inputText' => 'true'])



                @if(false && !(Request::segment(3)==='new'))
                <div class="col-sm-9 form-group">
                   @yield('child-selector')
                </div>
                @endif


            @include('admin.block.plain-text', ['name' =>'title', 'caption' => 'Название', 'inputText' => 'true'])



            <?php $name = 'difficulty'; $caption = 'Сложность'; ?>
            <div class="col-sm-9 form-group">
            <label class="col-sm-3 control-label text-right">
                {{ $caption  }}
            </label>

            <div class="col-sm-6">
                    <select class="form-control" name="{{$name}}">
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
            @include('admin.block.plain-text', ['name' =>'content', 'caption' => 'Описание'])
        </div>

    @endif
@endsection





@section('content')
    @include('admin.block.content-form')
@endsection

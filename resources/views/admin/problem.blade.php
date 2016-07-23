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
    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="upload_form" action="/upload" target="form_target" method="post" enctype="multipart/form-data"
          style="width:0px;height:0;overflow:hidden">
        <input name="image" type="file"
               onchange="$('#upload_form').ajaxSubmit({ success: function(d){eval(d);} });this.value='';"></form>


    {!! Form::open(
        array(
            'url' => url(Request::url() . "/save"),
            'class' => 'form-horizontal',
            'files' => true)) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="problem_id" value="@if(!old('problem_id')){{$problem->id}}@endif{{ old('problem_id') }}">

    @if (Request::segment(2)==='problem' && Request::segment(3)==='new')
        <h3>Новая задача</h3>
    @endif

    @include('admin.block.course_id-select',['page' => $problem])

    @include('admin.block.plain-text',
               ['page' => $problem,
                'name' =>'number',
                'caption' => 'Номер задачи',
                'inputText' => 'true',
                'default' => App\Problem::max('number')+1])

    @include('admin.block.plain-text', ['page' => $problem, 'name' =>'title', 'caption' => 'Название', 'inputText' => 'true'])
    @include('admin.block.difficulty-form-el',['page' => $problem])
    @include('admin.block.plain-text', ['page' => $problem, 'name' =>'score', 'caption' => 'Количество баллов', 'inputText' => 'true'])


    @include('admin.block.plain-text', ['page' => $problem, 'name' =>'description', 'caption' => 'Описание и вопрос', 'width' => 12])

    <?php $name = 'question'; $caption = 'Варианты ответа'; ?>
    <div class="col-sm-9 form-group">
        <label class="col-sm-3 control-label text-right">
            {{ $caption  }}
        </label>

        <div style="clear: both"></div>

        <div class="col-sm-12">
            <div class="tabbable" id="{{$name}}"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li @if($question->type == 'radio') class="active" @endif><a href="#tab1" data-toggle="tab">Одиночный
                            выбор</a></li>
                    <li @if($question->type == 'checkbox') class="active" @endif><a href="#tab2" data-toggle="tab">Множественный
                            выбор</a></li>
                    <li @if($question->type == 'single') class="active" @endif><a href="#tab3"
                                                                                  data-toggle="tab">Число</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane @if($question->type == 'radio') active @endif" id="tab1" data-type="radio">
                        @foreach($question->radio->texts as $i => $text)
                            <div class="col-sm-12 form-group" style="padding-top: 15px">
                                <div class="col-sm-1" style="margin-top: -4px">
                                    <input type="radio" name="radio_question" class="form-control"
                                           value="{{ $i }}"
                                           @if($i == $question->radio->number) checked="checked" @endif>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" name="radio_quesiton_text[]" class="form-control"
                                           value="{{ $text }}">
                                </div>
                                <button type="button" class="btn btn-default text-right minus"
                                        onclick="removeQuestion(this)"
                                        title="удалить">&ndash;</button>
                                @if($i == count($question->radio->texts) - 1)
                                    <button type="button" class="btn btn-default text-right plus"
                                            onclick="duplicateQuestionBlock(this)"
                                            title="добавить еще вариант">+
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane @if($question->type == 'checkbox') active @endif" id="tab2"
                         data-type="checkbox">
                        @foreach($question->checkbox->texts as $i => $text)
                            <div class="col-sm-12 form-group" style="padding-top: 15px">
                                <div class="col-sm-1" style="margin-top: -4px">
                                    <input type="checkbox" name="checkbox_question[]" class="form-control"
                                           value="{{ $i }}"
                                           @if($question->checkbox->numbers && in_array($i, $question->checkbox->numbers)) checked="checked" @endif>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="checkbox_quesiton_text[]" class="form-control"
                                           value="{{ $text }}">
                                </div>
                                <button type="button" class="btn btn-default text-right minus"
                                        onclick="removeQuestion(this)"
                                        title="удалить">&ndash;</button>
                                @if($i == count($question->checkbox->texts) - 1)
                                    <button type="button" class="btn btn-default text-right plus"
                                            onclick="duplicateQuestionBlock(this)"
                                            title="добавить еще вариант">+
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane @if($question->type == 'single') active @endif" id="tab3" data-type="single">
                        <div class="col-sm-12 form-group" style="padding-top: 15px">
                            <div class="col-sm-6 col-sm-offset-1">
                                <input type="text" name="single_quesiton" class="form-control"
                                       value="{{ $question->single }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function duplicateQuestionBlock(t) {
            $obj = $(t).parent();
            $new = $obj.clone();
            $n = $new.find('input[type=checkbox], input[type=radio]');
            $n.removeAttr('checked');
            $n.val(parseInt($n.val()) + 1);
            $new.find('input[type=text]').val('');
            $obj.after($new);

            $(t).remove();
        }
        $('#question').parents('form').submit(function (e) {
            var type = $('#question').find('div.active').attr('data-type');
            $(e.target).append('<input type="hidden" name="question_type" value="' + type + '">')
        });
        function removeQuestion(el) {
            if ($(el).parents('div.tab-pane').find('button.minus').last()[0] != el) {
                $(el).parent().remove();
            }
        }
    </script>

    @include('admin.block.plain-text', ['page' => $problem, 'name' =>'answer', 'caption' => 'Разъяснение решения', 'width' => 12])

    <?php $name = 'attempts'; $caption = 'Количество попыток'; ?>
    <div class="col-sm-9 form-group">
        <label class="col-sm-3 control-label text-right">
            {{ $caption  }}
        </label>

        <div class="col-sm-6">
            <select class="form-control" name="{{$name}}">
                <option value="1"
                <?= (empty(old($name)) ? $problem->$name : old($name)) == 1 ? 'selected' : '' ?>>
                    1
                </option>
                <option value="2"
                <?= (empty(old($name)) ? $problem->$name : old($name)) == 2 ? 'selected' : '' ?>>
                    2
                </option>
            </select>
        </div>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>

    <!-- =================== related lections =================== -->
    @if(count($problem->lections))
        <div class="col-sm-9 form-group">
            <label class="col-sm-3 control-label text-right">
                Прикрепленные лекции
            </label>

            <div class="col-sm-6 col-sm-offset-3 form-group">

                @foreach($problem->lections as $lection)
                    <div style="width:100%;min-height: 34px; margin-top: 5px">
                        <a href="{{ url('admin/lection/'.$lection->id )}}">{{ $lection->title }}</a>
                        <input type="hidden" name="lections[]" value="{{ $lection->id }}">
                        <button type="button" class="btn btn-default text-right" onclick="removeLection(this)"
                                title="удалить" style="position:absolute;right:0;margin-top:-9px">&ndash;</button>
                    </div>
                @endforeach
            </div>
            <script>
                function removeLection(el) {
                    $(el).parent().remove();
                }
            </script>
        </div>
    @endif
    <?php $name = 'new_lections[]'; $caption = 'Прикрепить лекции'; ?>
    <div class="col-sm-9 form-group">
        <label class="col-sm-3 control-label text-right">
            {{ $caption  }}
        </label>

        <div class="col-sm-6">
            <select class="form-control" name="{{$name}}" data-name="{{$name}}"></select>
        </div>
        <button type="button" class="btn btn-default text-right" onclick="duplicateAddLectionBlock(this)"
                title="прикрепить еще лекцию">+
        </button>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
    <style>
        .select2-chosen span[class*="icon-"] {
            vertical-align: sub;
            padding-right: 5px;
        }

        .select2-selection__clear {
            color: rgba(0, 0, 0, 0);
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
        var data = <?php echo json_encode(App\Page::whereIn('type', ['lection','comics'])->whereParentId(null)->select('id','title as text')->whereNotIn('id', $problem->lections()->getRelatedIds())->get());?>;

        function addLectlionsSelect2($el) {
            $($el).select2({
                data: data,
                placeholder: "выберите лекцию",
                allowClear: true,
                //width: "100%",
                //minimumResultsForSearch: "-1",
                language: "ru",
                closeOnSelect: true,
                id: null,
                escapeMarkup: function (m) {
                    return m;
                }
            }).on('select2:unselecting', function () {
                $(this).data('unselecting', true);
            }).on('select2:opening', function (e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            });
            $($el).val(null).trigger('change.select2');
        }
        function duplicateAddLectionBlock(t) {
            $obj = $(t).parent();
            $new = $obj.clone();
            $(t).remove();
            $new.find('span').first().remove();
            $new.find('select').replaceWith('<select class="form-control" name="{{$name}}" data-name="{{$name}}"></select>');
            $obj.after($new);
            addLectlionsSelect2($new.find('select'));
        }


        addLectlionsSelect2($('select[data-name="{{$name}}"]'));

        //$('select[data-name="parent_id"]').val({{ $page->parent_id or 'null' }}).trigger('change.select2');
        //$('select[data-name="{{$name}}"]').val(null).trigger('change.select2');
    </script>

    <div class="form-group col-sm-9">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-success col-sm-offset-1']) !!}
        @if(!empty($problem->id))
            <a href="{{  url(Request::url() . '/delete/?_token='.csrf_token()) }}"
               class="btn btn-danger">Удалить</a>
        @endif
    </div>



@endsection
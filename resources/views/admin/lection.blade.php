@extends('layouts.admin.main')

@section('parent-selector')
    <div class="col-sm-4 form-group  {{ $errors->has('parent_id') ? ' has-error' : '' }}" style="padding-left: 0px;">
        <select style="width: 100%;" placeholder="родительский элемент" name="parent_id"
                value="@if(!old('parent_id')){{$page->parent_id}}@endif{{ old('parent_id') }}"></select>

        @if ($errors->has('parent_id'))
            <span class="help-block">
                <strong>{{ $errors->first('parent_id') }}</strong>
            </span>
        @endif
    </div>
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
        var data = <?php echo json_encode(App\Page::whereType('lection')->whereParentId(null)->select('id','title as text')->get());?>;
        data.unshift({"id":"-1","text":"&nbsp;"})
        $('select[name="parent_id"]').select2({//http://stackoverflow.com/questions/29618382/disable-dropdown-opening-on-select2-clear
            data:data,
            placeholder: "Родитель",
            allowClear: true,
            minimumResultsForSearch: "-1",
            closeOnSelect: true,
            id: "Родитель",
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

        $('select[name="parent_id"]').val({{ $page->parent_id or 'null' }}).trigger('change.select2');
    </script>
@endsection
@section('content')
    @include('admin.block.content-form')
@endsection

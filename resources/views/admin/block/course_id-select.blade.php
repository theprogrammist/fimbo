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
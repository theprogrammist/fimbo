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
<?php $p = isset($page->contentHash) ? $page->contentHash : $page ?>
<div class="<?=isset($page->contentHash) ?'':' col-sm-9 '?>form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="col-sm-3 control-label text-right">
        {{ $caption  }}
    </label>

    <div class="col-sm-{{ isset($width) ? $width : 6 }}">
        @if(in_array($name,['youtubelink','learn','solve','use','earn']) || isset($inputText))
            <input type="text" name="{{$name}}" class="form-control" value="@if(!old($name)){{$p->$name}}@endif{{ old($name) }}<?php if(empty(old($name)) && empty($page->$name) && isset($default)) echo $default;?>"/>
        @else
            <textarea name="{{$name}}" class="form-control">@if(!old($name)){{$p->$name}}@endif{{ old($name) }}</textarea>
        @endif
    </div>
    @if ($errors->has($name))
        <span class="help-block">
                    <strong>{{ $errors->first($name) }}</strong>
                </span>
    @endif
</div>
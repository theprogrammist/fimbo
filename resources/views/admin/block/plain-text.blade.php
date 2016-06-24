<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="col-sm-3 control-label text-right">
        {{ $caption  }}
    </label>

    <div class="col-sm-6">
        @if(in_array($name,['youtubelink','learn','solve','use','earn']))
            <input type="text" name="{{$name}}" class="form-control" value="@if(!old($name)){{$page->contentHash->$name}}@endif{{ old($name) }}"/>
        @else
            <textarea name="{{$name}}" class="form-control">@if(!old($name)){{$page->contentHash->$name}}@endif{{ old($name) }}</textarea>
        @endif
    </div>
    @if ($errors->has($name))
        <span class="help-block">
                    <strong>{{ $errors->first($name) }}</strong>
                </span>
    @endif
</div>
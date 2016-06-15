@extends('auth.registration')

@section('content')
    @parent

<div class="content-full content-full_six">
    <div class="content-full__items">
        <div class="content-full__item active-done">
            <div class="content-full__item-title">личные данные</div>
            <div class="content-full__item-icon content-full__item-icon_personal"></div>
        </div>
        <div class="content-full__item {{$resultClass}}">
            <div class="content-full__item-title">подтверждение почты</div>
            <div class="content-full__item-icon content-full__item-icon_email"></div>
        </div>
    </div>
</div>
<div class="content-info">
    <div class="content-info__text"><?=$resultMessage?></div>
</div>
    @if(isset($resultRedirect))
        <script language="JavaScript">
            setTimeout(function(){window.location.href = "{{$resultRedirect}}"; }, 5000);
        </script>
    @endif
@endsection

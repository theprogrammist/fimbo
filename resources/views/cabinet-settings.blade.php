@extends('layouts.app')

@section('html-page-title')
    FIMBO.RU - настройки
@overwrite
@section('login-popup')
@overwrite

@section('content')
<div class="content js-content">
    <div class="content-left content-left_cabinet">
        <div class="cab-setting">
            <div class="cab-setting__title"><span>Настройки</span>
            </div>
            <form class="cab-setting-content js-valid-form" action="{{ url('settings') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="cab-setting__ava">
                    <div class="cab-profile__ava">
                        <img src="img/ava-big.jpg" alt="ava" class="cab-profile__ava-img">
                    </div><a href="javascript:void(0);" class="new-photo js-new-photo">Обновить</a>
                    <input type="file" class="new-photo-input js-new-photo-input" name="avatar"><a href="javascript:void(0);" class="delete-photo js-delete-photo">Удалить</a>
                </div>
                <div class="cab-setting__info">
                    <div class="cab-setting__left">
                        <div class="content-info__item">
                            <label class="label content-info__label">Псевдоним</label>
                            @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif
                            <input type="text" name="name" minlength="2" required value="@if(!old('name')){{$user->name}}@endif{{ old('name') }}" class="input content-info__input">
                            <a href="javascript:void(0);" class="edit js-edit"></a>
                        </div>
                        <div class="content-info__item">
                            <label class="label content-info__label">Ссылка на профиль в социальной сети</label>
                            @if ($errors->has('soctype')) <span class="help-block"> <strong>{{ $errors->first('soctype') }}</strong> </span> @endif
                            <select class="select content-info__input content-info__select" name="soctype">
                                <option value="vk" @if(!old('soctype')) {{($user->soctype=='vk'?'selected="selected"':'')}} @endif {{(old('soctype')=='vk'?'selected="selected"':'')}}>Вконтакте</option>
                                <option value="ok" @if(!old('soctype')) {{($user->soctype=='ok'?'selected="selected"':'')}} @endif {{(old('soctype')=='ok'?'selected="selected"':'')}}>Одноклассники</option>
                                <option value="fb" @if(!old('soctype')) {{($user->soctype=='fb'?'selected="selected"':'')}} @endif {{(old('soctype')=='fb'?'selected="selected"':'')}}>Facebook</option>
                            </select>

                            @if ($errors->has('url')) <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span> @endif
                            <input type="url" placeholder="Ссылка" name="url" value="@if(!old('url')){{$user->url}}@endif{{ old('url') }}" class="input content-info__input">
                        </div>
                    </div>
                    <div class="cab-setting__right">
                        <div class="content-info__item">
                            <label class="label content-info__label">Пароль</label>
                            @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif
                            <input type="password" name="password" minlength="2" class="input content-info__input">
                            <a href="javascript:void(0);" class="edit js-edit"></a>
                        </div>
                        <div class="content-info__item">
                            <label class="label content-info__label">Электронная почта</label>
                            @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                            <input type="email" name="email" required value="@if(!old('email')){{$user->email}}@endif{{ old('email') }}" class="input content-info__input">

                            <a href="javascript:void(0);" class="edit js-edit"></a>
                            <div class="email-success">Подтвержден</div>
                        </div>
                    </div>
                    <div class="cab-setting__subscribe">Рассылки и уведомления</div>
                    @if ($errors->has('newsletters')) <span class="help-block"> <strong>{{ $errors->first('newsletters') }}</strong> </span> @endif
                    <label class="cab-setting__subscribe-label">
                        <input type="checkbox" class="check-subscribe" name="newsletters" value="1"
                            @if(!old('newsletters')) {{($user->newsletters?'checked="checked"':'')}} @endif {{(old('newsletters')?'checked="checked"':'')}}>
                        Напоминать о задачах по электронной почте</label>
                        <a href="javascript:void(0);" class="btn cab-setting__save" onclick="$(this).parents('form').submit();">применить настройки</a>
                </div>
            </form>
        </div>
        <br/>
        @if($user->account)
            <div class="cab-setting__title"><span>Ваш текущий баланс составляет: {{$user->account->balance}} Monetto.</span></div>
        @endif

        @foreach($user->account->actions()->get() as $i => $action)
            <div class="row">
                <div class="cab-setting__subscribe" style="width: 50px;float: left">{{$i+1}}</div>
                <div class="cab-setting__subscribe" style="width: 250px;float: left">{{$action->created_at}}</div>
                <div class="cab-setting__subscribe" style="width: 350px;float: left">{{$action->description?:App\Pricetype::find($action->pricetype_id)->description}}</div>
                <div class="cab-setting__subscribe" style="width: 200px;float: left">{{$action->cost}} Monetto</div>
                <div style="clear:both"></div>
            </div>
        @endforeach
        <style>
            div.row{
                padding-left: 20px;
                padding-top: 16px;
            }
            div.row:nth-child(odd) {
                background-color: rgba(100,149,237,0.15);
            }
        </style>

    </div>
    <div class="content-right js-content-right">
        <div class="decide-today">
            <div class="decide-today__title">Задачи на сегодня</div>
            <div class="decide-today__content"><a href="javascript:void(0);" class="decide-today__link decide-today__link_erud">эрудиция </a><a href="javascript:void(0);" class="decide-today__link decide-today__link_mat">математика </a><a href="javascript:void(0);" class="decide-today__link decide-today__link_eng">английский язык </a>
                <a
                        href="javascript:void(0);" class="decide-today__link decide-today__link_finance">финансы</a><a href="javascript:void(0);" class="decide-today__link decide-today__link_econom"> экономика </a>
            </div>
        </div>
        <a href="javascript:void(0);" class="banner">
            <img src="img/banner1.png" alt="banner" class="banner__img"><span class="banner__text">10 удивительных фильмов 2015 года</span>
        </a>
        <a href="javascript:void(0);" class="banner banner_ads">
            <img src="img/banner2.png" alt="banner" class="banner__img"><span class="banner__text"><span class="banner__text-span">Скоро олимпиада!</span>Вступительный взнос 5000 очков</span>
        </a>
    </div>
</div>
@endsection
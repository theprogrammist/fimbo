@extends('auth.registration')

@section('content')
    @parent

    <div class="content-info">
        <form role="form" method="post" class="content-info__form js-valid-form" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="content-info__col">
                <div class="content-info__item {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="label content-info__label">Имя</label>
                    <input type="text" name="name" minlength="2" required class="input content-info__input" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class=" content-info__item {{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label class="label content-info__label">Фамилия</label>
                    <input type="text" name="lastname" minlength="2" required class="input content-info__input" value="{{ old('lastname') }}">
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class=" content-info__item {{ $errors->has('birthdate') ? ' has-error' : '' }}">
                    <label class="label content-info__label">Дата рождения</label>
                    <div class="datepicker">
                        <input type="text" name="rubirthdate" required class="input content-info__input content-info__input_date js-datepicker" value="{{ old('rubirthdate') }}">
                        <input type="hidden" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                        @if ($errors->has('birthdate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birthdate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class=" content-info__item">
                    <label class="label content-info__label">Ссылка на профиль в социальной сети</label>
                    <select class="select content-info__input content-info__select">
                        <option>Вконтакте</option>
                        <option>Одноклассники</option>
                        <option>Facebook</option>
                    </select>
                    <input type="text" placeholder="Ссылка" name="url" class="input content-info__input js-soc-url">
                </div>
            </div>
            <div class="content-info__col">
                <div class=" content-info__item {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="label content-info__label">Пароль</label>
                    <input type="password" name="password" minlength="6" required id="pass" class="input content-info__input">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class=" content-info__item {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="label content-info__label">Подтверждение пароля</label>
                    <input type="password"  name="password_confirmation" equalTo="#pass" required class="input content-info__input">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class=" content-info__item {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="label content-info__label">Электронная почта</label>
                    <input type="email" name="email" required class="input content-info__input" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="content-info__buttons">
                <button class="btn content-info__button content-info__button_next" type="submit">далее</button>
                <button type="reset" class="btn content-info__button content-info__button_cancel">Отменить</button>
            </div>
            <div class="rules">Нажимая кнопку “Далее”, Вы принимаете <a href="javascript:void(0);" class="rules__link">Пользовательское соглашение</a>
            </div>
        </form>
    </div>
@endsection

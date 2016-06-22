@extends('layouts.admin.main')

@section('content')
    <h1 class="page-header">Пульс</h1>

    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Пользователи</h4>
            <span class="text-muted">Зарегистрированно активно</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Посетители</h4>
            <span class="text-muted">За последний час</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Лекций</h4>
            <span class="text-muted">Просмотрено</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Задачи</h4>
            <span class="text-muted">Решено</span>
        </div>
    </div>

    <h2 class="sub-header">Пользователи</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Дата рождения</th>
                <th>Эл. почта</th>
                <th>Подтверждена</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)

                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->confirmed ? "да" : "нет" }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
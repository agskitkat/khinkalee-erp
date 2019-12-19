@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Пользователи</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('user/edit') }}">Добавить пользователя</a>
        </form>
    </nav>
    <div class="filial-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Адрес</th>
                <th scope="col">Роль</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(count($user->roles))
                            @foreach($user->roles as $role)
                                <span>{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span>Нет ролей</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user/delete', ['id'=>$user->id]) }}">Удалить</a>
                        <a href="{{ route('user/edit', ['id'=>$user->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

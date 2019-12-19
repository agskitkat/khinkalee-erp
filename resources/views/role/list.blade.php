@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Роли пользователей</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('role/edit') }}">Добавить роль</a>
        </form>
    </nav>
    <div class="filial-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Код</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $role)
                <tr>
                    <th>{{ $role->id }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->code }}</td>
                    <td>
                        <a href="{{ route('role/delete', ['id'=>$role->id]) }}">Удалить</a>
                        <a href="{{ route('role/edit', ['id'=>$role->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

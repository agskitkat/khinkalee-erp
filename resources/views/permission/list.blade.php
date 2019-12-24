@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Операции</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('permission/edit') }}">Добавить операцию</a>
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
            @foreach($list as $permission)
                <tr>
                    <th>{{ $permission->id }}</th>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->code }}</td>
                    <td>
                        <a href="{{ route('permission/delete', ['id'=>$permission->id]) }}">Удалить</a>
                        <a href="{{ route('permission/edit', ['id'=>$permission->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Филиалы</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('filial/edit') }}">Добавить филиал</a>
        </form>
    </nav>
    <div class="filial-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Адрес</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $filial)
                <tr>
                    <th>{{ $filial->id }}</th>
                    <td>{{ $filial->name }}</td>
                    <td>{{ $filial->address }}</td>
                    <td>
                        <a href="{{ route('filial/delete', ['id'=>$filial->id]) }}">Удалить</a>
                        <a href="{{ route('filial/edit', ['id'=>$filial->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

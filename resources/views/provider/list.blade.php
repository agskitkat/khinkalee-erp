@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Поставщики</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('provider/edit') }}">Добавить поставщика</a>
        </form>
    </nav>
    <div class="filial-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Email</th>
                <th scope="col">Товаров</th>
                <th scope="col">Синхронизация</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $provider)
                <tr>
                    <th>{{ $provider->id }}</th>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>{{ $provider->countProduct() }}</td>
                    <td>
                        <a href="{{route('providers/excel',  ['id'=>$provider->id])}}">Excel</a>
                    </td>
                    <td>
                        <a href="{{ route('provider/delete', ['id'=>$provider->id]) }}">Удалить</a>
                        <a href="{{ route('provider/edit', ['id'=>$provider->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

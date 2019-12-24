@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Группы продуктов</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('group/edit') }}">Добавить продукт</a>

        </form>
    </nav>
    <div class="filial-list">


        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Сортировка</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $group)
                <tr>
                    <th>{{ $group->id }}</th>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->sort }}</td>
                    <td>
                        <a href="{{ route('group/delete', ['id'=>$group->id]) }}">Удалить</a>
                        <a href="{{ route('group/edit', ['id'=>$group->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
</div>
@endsection

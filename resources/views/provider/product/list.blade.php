@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Тоавры поставщиков</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('provider-product/edit') }}">Добавить товар</a>
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
            @foreach($list as $product)
                <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->email }}</td>
                    <td>{{ $product->countProduct() }}</td>
                    <td>
                        <a href="#">Excel</a>
                    </td>
                    <td>
                        <a href="{{ route('provider-product/delete', ['id'=>$product->id]) }}">Удалить</a>
                        <a href="{{ route('provider-product/edit', ['id'=>$product->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

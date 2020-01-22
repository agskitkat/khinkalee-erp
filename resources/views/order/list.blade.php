@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Список заказов</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('order/edit') }}">Создать заказ</a>
        </form>
    </nav>
    <div class="filial-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата</th>
                <th scope="col">Статус</th>
                <th scope="col">Филиал</th>
                <th scope="col">Пользователь</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $order)
                <tr>
                    <th>{{ $order->id }}</th>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->getFilial() }}</td>
                    <td>{{ $order->getUser()['name'] }}</td>

                    <td>
                        <a href="{{ route('order/delete', ['id'=>$order->id]) }}">Удалить</a>
                        <a href="{{ route('order/edit', ['id'=>$order->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

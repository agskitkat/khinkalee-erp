@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Продукты</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{ route('product/edit') }}">Добавить продукт</a>

        </form>
    </nav>
    <div class="filial-list">


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Связанный товар</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <td colspan="4">
                        <h3>{{$group->name}}</h3>
                    </td>
                </tr>
                @if(count($products = $group->getProducts()))
                    @foreach($products as $product)
                        <tr>
                            <th>{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->getStrong()['name'] }}</td>
                            <td>
                                <a href="{{ route('product/delete', ['id'=>$product->id]) }}">Удалить</a>
                                <a href="{{ route('product/edit', ['id'=>$product->id]) }}">Редактировать</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">
                            Группа пуста
                        </td>
                    </tr>
                @endif
            @endforeach
            @if(count($outOfGroup))

                <tr>
                    <td colspan="4">
                        <h3>Продукты без группы</h3>
                    </td>
                </tr>

                @foreach($outOfGroup as $product)
                    <tr>
                        <th>{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->getStrong()['name'] }}</td>
                        <td>
                            <a href="{{ route('product/delete', ['id'=>$product->id]) }}">Удалить</a>
                            <a href="{{ route('product/edit', ['id'=>$product->id]) }}">Редактировать</a>
                        </td>
                    </tr>
                @endforeach

            @endif
            </tbody>
        </table>


    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="editform">
        <h1>Результат загрузки {{$provider->name}}</h1>
        <div>
            <b>Обновлено: {{count($products)}} товаров</b>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Еденицы</th>
                <th scope="col">Цена</th>
                <th scope="col">Масса в кг.</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->measure }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->mass }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

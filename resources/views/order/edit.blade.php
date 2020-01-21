@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$order->id)
        <h1>Создать закупку</h1>
    @else
        <h1>Закупка: №{{$order->id}} от {{$order->created_at}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('order/save') }}" method="post" class="col-lg-8">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Название</label>
                <input maxlength="255"
                       value="{{$order->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Название">
            </div>
            <div class="form-group">
                <label>Комментарий к закупке</label>
                <textarea type="text"
                       value="{{$order->comment}}"
                       class="form-control"
                       name="code"
                        placeholder="Комментарий">

                </textarea>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Ед. измерения</th>
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
                                <td>{{ $product->name }}</td>
                                <td>
                                    <input class="form-control" name="product[{{ $product->id }}][count]" type="number" min="0">
                                </td>
                                <td>
                                    <select class="form-control" name="product[{{ $product->id }}][measure]">
                                        <option value="mass">кг.</option>
                                        <option value="item">шт.</option>
                                    </select>
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

            @if(!$order->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$order->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

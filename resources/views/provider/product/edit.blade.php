@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$product->id)
        <h1>Новый продукт поставщика</h1>
    @else
        <h1>Продукт поставщика: {{$product->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('provider-product/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden" name="id">
            <div class="form-group">
                <label>Продукт поставщика</label>
                <input maxlength="255"
                       value="{{$product->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Название">
            </div>
            <div class="form-group">
                <label>Уникалный код проукта(артикул)</label>
                <input type="text"
                       value="{{$product->article}}"
                       class="form-control"
                       name="article"
                       placeholder="Артикул">
            </div>
            <div class="form-group">
                <label>Поставщик</label>
                <input type="number"
                       value="{{$product->providers_id}}"
                       class="form-control"
                       name="providers_id"
                       placeholder="Поставщик">
            </div>
            <div class="form-group">
                <label>Вес еденицы в кг, если 0 то заказать можно только еденицами измерений</label>
                <input type="number"
                       value="{{$product->mass}}"
                       class="form-control"
                       name="mass"
                       placeholder="Вес в кг">
            </div>
            <div class="form-group">
                <label>Еденица измерения</label>
                <input type="text"
                       value="{{$product->measure}}"
                       class="form-control"
                       name="measure"
                       placeholder="Еденица измерения">
            </div>
            <div class="form-group">
                <label>Цена за еденицу измерения в рублях</label>
                <input type="number"
                       value="{{$product->price}}"
                       class="form-control"
                       name="price"
                       placeholder="Цена">
            </div>
            <div class="form-group">
                <label>Кратность заказа еденицы</label>
                <input type="number"
                       value="{{$product->divider}}"
                       class="form-control"
                       name="divider"
                       placeholder="Делитель">
                <small id="emailHelp" class="form-text text-muted">Если указать 1 - только целой единицей товара, если 2 - можно по полоыине единицы.</small>
            </div>

            @if(!$product->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$product->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$product->id)
        <h1>Новый продукт</h1>
    @else
        <h1>Продукт: {{$product->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('product/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Наименование продукта</label>
                <input maxlength="255"
                       value="{{$product->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Наименование продукта">
            </div>
            <div class="form-group">
                <label>Группа</label>
                <select class="form-control" name="id_product_group">
                    <option value="">Без группы</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}" @if($group->id === $product->id_product_group) selected @endif>{{$group->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Жёская привязка к товару поставщика</label>
                <Searchppc
                    placeholder="Жёская привязка к товару поставщика"
                    name="strong_rel"
                    type="number"
                    value="{{$product->strong_rel}}"
                    valuename="{{ $product->getStrong()['name'] }}"
                    url="{{route('provider-products/search')}}"
                    csrf="{{ csrf_token() }}">
                </Searchppc>
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

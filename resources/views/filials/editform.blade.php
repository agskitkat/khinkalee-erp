@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$filial->id)
        <h1>Новый филиал</h1>
    @else
        <h1>Филиал: {{$filial->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('filial/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label for="formGroupExampleInput">Название филиала</label>
                <input maxlength="255"
                       value="{{$filial->name}}"
                       type="text"
                       class="form-control"
                       id="formGroupExampleInput"
                       name="name"
                       placeholder="Название филиала">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Адрес филиала</label>
                <input type="text"
                       value="{{$filial->address}}"
                       class="form-control"
                       id="formGroupExampleInput2"
                       name="address"
                       placeholder="Адрес филиала">
                <small id="emailHelp" class="form-text text-muted">Используется для формирования доставки</small>
            </div>

            @if(!$filial->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$filial->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

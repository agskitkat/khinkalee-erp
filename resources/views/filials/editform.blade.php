@extends('layouts.app')

@section('content')
<div class="editform">
    <h1>Новый филиал</h1>
    <div class="row">
        <form action="{{ route('filial/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label for="formGroupExampleInput">Название филиала</label>
                <input maxlength="255" type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Название филиала">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Адрес филиала</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="address" placeholder="Адрес филиала">
                <small id="emailHelp" class="form-text text-muted">Используется для формирования доставки</small>
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>
@endsection

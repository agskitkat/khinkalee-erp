@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$permission->id)
        <h1>Новая операция</h1>
    @else
        <h1>Операция: {{$permission->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('permission/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Название операции</label>
                <input maxlength="255"
                       value="{{$permission->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Название операции">
            </div>
            <div class="form-group">
                <label>Код</label>
                <input type="text"
                       value="{{$permission->code}}"
                       class="form-control"
                       name="code"
                       placeholder="Код операции">
            </div>
            @if(!$permission->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$permission->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

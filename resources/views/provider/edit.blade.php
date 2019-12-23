@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$provider->id)
        <h1>Новый поставщик</h1>
    @else
        <h1>Поставщик: {{$provider->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('provider/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Поставщик</label>
                <input maxlength="255"
                       value="{{$provider->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Название поставщика">
            </div>
            <div class="form-group">
                <label>Email адрес для закза</label>
                <input type="text"
                       value="{{$provider->email}}"
                       class="form-control"
                       name="email"
                       placeholder="Email">
            </div>
            @if(!$provider->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$provider->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

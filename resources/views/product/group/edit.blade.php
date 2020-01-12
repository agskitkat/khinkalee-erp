@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$group->id)
        <h1>Новая группа продуктов</h1>
    @else
        <h1>Группа продуктов: {{$group->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('group/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Наименование группы</label>
                <input maxlength="255"
                       value="{{$group->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Наименование группы">
            </div>
            <div class="form-group">
                <label>Сортировка</label>
                <input type="number"
                       value="{{$group->sort}}"
                       class="form-control"
                       name="sort"
                       placeholder="Сортировка">
            </div>
            @if(!$group->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$group->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

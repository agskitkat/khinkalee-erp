@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$role->id)
        <h1>Новая роль</h1>
    @else
        <h1>Роль: {{$role->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('role/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Название</label>
                <input maxlength="255"
                       value="{{$role->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Название">
            </div>
            <div class="form-group">
                <label>Код</label>
                <input type="text"
                       value="{{$role->code}}"
                       class="form-control"
                       name="code"
                       placeholder="Код">
            </div>

            <div class="form-group">
                <label>Допустимые операции</label>
                @if($permissionsList)
                    @foreach($permissionsList as $p)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $p->id }}" @if($role->hasPermission($p->code)) checked @endif>
                            <label class="form-check-label">
                                {{$p->name}}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>

            @if(!$role->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$role->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

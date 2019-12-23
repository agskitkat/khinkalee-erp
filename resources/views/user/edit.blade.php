@extends('layouts.app')

@section('content')
<div class="editform">

    @if(!$user->id)
        <h1>Новый пользователь</h1>
    @else
        <h1>Пользователь: {{$user->name}}</h1>
    @endif

    <div class="row">
        <form action="{{ route('user/save') }}" method="post" class="col-lg-6">
            @csrf
            <input type="hidden"name="id">
            <div class="form-group">
                <label>Имя пользователя</label>
                <input maxlength="255"
                       value="{{$user->name}}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Название филиала">
            </div>
            <div class="form-group">
                <label >Email</label>
                <input type="text"
                       value="{{$user->email}}"
                       class="form-control"
                       name="email"
                       placeholder="Адрес филиала">
            </div>
            <div class="form-group">
                <label>Роли</label>
                @if($roles)
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if($user->hasRole($role->code)) checked @endif>
                            <label class="form-check-label">
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            @if(!$user->id)
                <button type="submit" class="btn btn-primary">Создать</button>
            @else
                <input type="hidden" name="id" value="{{$user->id}}">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @endif
        </form>
    </div>
</div>
@endsection

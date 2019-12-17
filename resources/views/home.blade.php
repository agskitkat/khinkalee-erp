@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page" id="orders">
                <h1>Закупки</h1>

            </div>

            <products></products>

            <div class="page" id="providers">
                <h1>Поставщики</h1>
            </div>

            <div class="page" id="users">
                <h1>Пользователи</h1>
            </div>
        </div>
    </div>
@endsection

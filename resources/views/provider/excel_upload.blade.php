@extends('layouts.app')

@section('content')
    <div class="editform">
        <h1>Автоматическая загрузка {{$provider->name}}</h1>
        <div class="row">
            <form enctype="multipart/form-data" action="{{ route('providers/excel_process', ['id' => $provider->id]) }}" method="post" class="col-lg-6">
                @csrf
                <div class="form-group">
                    <label>Файл .xlsx</label>
                    <input type="file" name="xlsx" class="form-control-file">
                </div>
                <input type="hidden" name="id" value="{{$provider->id}}">
                <button type="submit" class="btn btn-primary">Обновить товары поставщика</button>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Филиалы</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-primary" href="{{route('filial/edit')}}">Добавить филиал</a>
        </form>
    </nav>
    <div class="filial-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $filial)
                <div class="filial-list__filial">
                    {{ $filial->id }}
                </div>
                <tr>
                    <th>{{ $filial->id }}</th>
                    <td>{{ $filial->name }}</td>
                    <td>{{ $filial->address }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection

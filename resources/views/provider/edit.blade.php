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
            <div class="form-group">
                <label>Правила обработки Excel в формате JSON</label>
                <textarea rows="15" class="form-control" name="excel_rules">{{$provider->excel_rules}}</textarea>
                <br><br><h4>Блок sittings</h4>

                <p><b>offsetRows</b> - Сколько строк отступить сверху, допустим убрать хедер таблицы</p>
                <p><b>goodRowCountParam</b> - Количество заполненых колонок в строке, определяющих валидную строку. </p>

                <br><h4>Блок article, price, mass, measure, name, divider</h4>
                <p>Определяю соответственно какое поле будет обработано в данном параметре товара.</p>
                <p>Подблоки применяются по очереди в приведённом порядке.</p>
                <p><b>expression</b> - Правило при положительном результате которого, будет выполнены обработка правила. Если условного правила нет, текущее правило не выполнится. Но сам параметр не обязателен.</p>
                <p><b>recursive</b> - массив со спискои имён правил поиска, используется по очереди до первого удачного найденого результата вложенных функций.</p>
                <p><b>ismass</b> - является массой, результат приводится в кг, если обнаружены единици измерения массы в результате. Приводится к числу без преобразования, если еденицы не определены. <br>Возможные варианты массовых едениц измерения: кг, г, гр, грам, грамм, ц, цен, цн, т, тн, тонн, тонна</p>
                <p><b>pos</b> - номер колонки в строке нахождение параметра.</p>
                <p><b>regexp</b> - поиск по регулярному рыражению, допустим если надо выделить массу из названия</p>
                <p><b>sprintf</b> - форматирование строки, например денежной или числовой (гугли <i>php sprintf</i>)</p>
                <p><b>default</b> - значение по умолчанию</p>
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

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Нарушения.нет</title>
</head>
<body>
    <x-app-layout>
        <div>
            <span>Сортировка по дате создания: </span>
            <a href="{{ route('reports.index', ['sort' => 'desc', 'status' => $status]) }}">сначала новые</a>
            <a href="{{ route('reports.index', ['sort' => 'asc', 'status' => $status]) }}">сначала старые</a>
        </div>
        <div>
            <p>Фильтрация по статусу заявки</p>
            <ul>
                @foreach($statuses as $status)
                    <li>
                        <a href="{{route('reports.index', ['sort' => $sort, 'status' => $status->id])}}">
                            {{$status->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @foreach ($reports as $report)
        <p> {{ $report->number }} </p>
        <p> {{ $report->description }} </p>
        <p> {{ $report->created_at }} </p>
        <p> {{ $report->status->name }} </p>
        <a href="{{ route('reports.edit', $report->id) }}">Обновить</a>
        <form action="{{route('reports.destroy', $report->id)}}" method="POST">
            @method('delete')
            @csrf
            <input type="submit" value="Удалить">
        </form>
    @endforeach
    {{ $reports->links() }}
    </x-app-layout>
<a href="{{ route('reports.create') }}">Создать заявление</a>
</body>
</html>
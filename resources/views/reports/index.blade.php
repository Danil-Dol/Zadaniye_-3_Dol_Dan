<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушения.нет</title>
</head>
<body>
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
<a href="{{ route('reports.create') }}">Создать заявление</a>
</body>
</html>
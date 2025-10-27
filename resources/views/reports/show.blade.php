<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновить</title>
</head>
<body>
    <form action="{{route('reports.update', $report->id)}}" method="POST">
        @csrf
        @method('put')
        <input name="number" value="{{$report->number}}">
        <textarea name="description">{{$report->description}}</textarea>
        <input type="submit" value="Обновить">
    </form>
</body>
</html>
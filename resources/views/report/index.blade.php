<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушения.нет</title>
</head>
<body>
@foreach ($number as $num)
    <p>Это пользователь {{ $num->id }}</p>
@endforeach
</body>
</html>
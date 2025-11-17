
    <x-app-layout>
        <form action="{{route('reports.store')}}" method="POST">
            @csrf
            <input placeholder="Введите госномер" name="number">
            <textarea name="description" placeholder="Введите описание"></textarea>
            <input type="submit" value="Создать">
        </form>
    </x-app-layout>

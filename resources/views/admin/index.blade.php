<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Панель администратора</h1>
        
        @if($reports->count() > 0)
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($reports as $report)
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Заявка #{{ $report->id }} - {{ $report->number }}
                                </h3>
                                <p class="text-sm text-gray-500">{{ $report->description }}</p>
                                <p class="text-xs text-gray-400">
                                    Создана: {{ $report->created_at->format('d.m.Y H:i') }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    Автор: {{ $report->user->name }}
                                </p>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <!-- Форма изменения статуса -->
                                <form class="status-form" action="{{ route('reports.status.update', $report->id) }}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <select name="status_id" id="status_id" class="py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @if($report->status_id != 1) bg-gray-100 cursor-not-allowed @endif" @if($report->status_id != 1) disabled @endif>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $status->id === $report->status_id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                        @endforeach
                                    </select>
    
                                    <!-- Показываем текущий статус, если select заблокирован -->
                                    @if($report->status_id != 1)
                                        <input type="hidden" name="status_id" value="{{ $report->status_id }}">
                                        <!--<div class="text-sm text-gray-500 mt-1">
                                            Текущий статус: <span class="font-medium">{{ $report->status->name }}</span>
                                        </div>-->
                                    @endif
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Пагинация -->
            <div class="mt-6">
                {{ $reports->links() }}
            </div>
        @else
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <p class="text-gray-500">Заявок пока нет</p>
            </div>
        @endif
    </div>

    <script>
        // Автоматическая отправка формы при изменении статуса
        document.addEventListener('DOMContentLoaded', function() {
            const selectElements = document.querySelectorAll('.status-form #status_id');
            for (let elem of selectElements) {
                elem.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        });
    </script>
</x-app-layout>
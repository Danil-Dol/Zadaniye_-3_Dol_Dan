<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Получаем все заявки для администратора
        $reports = Report::with(['user', 'status'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        
        // Получаем все статусы
        $statuses = Status::all();
        
        // Передаем только необходимые переменные
        return view('admin.index', compact('reports', 'statuses'));
    }
}

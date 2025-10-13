<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        $reports= Report::all(); //выборка всех данных из таблицы reports
        return view('report.index', compact('reports'));
    }
}

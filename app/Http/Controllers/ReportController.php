<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        //$reports= Report::all(); //выборка всех данных из таблицы reports
        $reports= Report::paginate(8);
        return view('reports.index', compact('reports'));
    }

    public function store (Request $request, Report $report)
    {
        $data = $request-> validate([
            'number' => 'string',
            'description' => 'string',
        ]);

        $report->create($data);
        return redirect()->back();
    }

    public function edit(Request $request, Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function update (Request $request, Report $report)
    {
        $data = $request-> validate([
            'number' => 'string',
            'description' => 'string',
        ]);

        $report->update($data);
        return redirect()->back();
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        //$reports= Report::all(); //выборка всех данных из таблицы reports
        /*$sort= $request->input('sort');
        if ($sort == 'asc' || $sort == 'desc')
        {
            $reports = Report::orderBy('created_at', $sort)
                    ->paginate(8);
        }
        else
        {
            $reports = Report::paginate(8);
        }
        $statuses = Status::all();

        $status = $request->input('status');
        $validate = $request->validate([
            'status' => "exists:statuses,id"
        ]);
        if ($validate)
        {
            $reports = Report::where('status_id', $status)
                    ->paginate(8);
        }
        else
        {
            $reports = Report::paginate(8);
        }
        return view('reports.index', compact('reports', 'statuses', 'sort', 'status'));*/
        $sort = $request->input('sort');
        if($sort != 'asc' && $sort != 'desc' )
        { 
            $sort = 'desc';
        }

        $status = $request->input('status');
        $validate = $request->validate([
            'status' => "exists:statuses,id"
        ]);

        if($validate)
        {
            $reports = Report::where('status_id', $status)
                ->orderBy('created_at', $sort)
                ->paginate(8);
        }
        else
        {
            $reports = Report::orderBy('created_at', $sort)
                ->paginate(8);
        }
        $statuses = Status::all();
        return view('reports.index', compact ('reports', 'statuses', 'sort', 'status'));
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

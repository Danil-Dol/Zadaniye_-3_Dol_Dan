<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(8);
        }
        else
        {
            $reports = Report::where('user_id', Auth::user()->id)
                ->orderBy('created_at', $sort)
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

        // добавляем дополнительные поля к $data
        $data['user_id'] = Auth::user()->id;
        $data['status_id'] = 1;

        $report->create($data);
        return redirect()->back();
    }

    public function edit(Request $request, Report $report)
    {
        if (Auth::user()->id === $report->user_id)
        {
            return view('reports.show', compact('report'));
        }
        else
        {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function update (Request $request, Report $report)
    {
        if (Auth::user()->id === $report->user_id)
        {
            $data = $request->validate([
                'number' => 'string',
                'description' => 'string',
            ]);

            $report->update($data);
            return redirect()->back();
        }
        else
        {
            abort(403, 'У вас нет прав на обновление этой записи.');
        }
    }

    public function destroy(Report $report)
    {
        if (Auth::user()->id === $report->user_id)
        {
            $report->delete();
            return redirect()->back();
        }
        else
        {
            abort(403, 'У вас нет прав на удаление этой записи.');
        }
    }

    public function show(Request $request, Report $report)
    {
        if (Auth::user()->id === $report->user_id)
        {
            return view('reports.show', compact('report'));
        }
        else
        {
            abort(403, 'У вас нет прав на просмотр этой записи.');
        }
    }
}

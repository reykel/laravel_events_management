<?php

namespace App\Exports;

use App\Models\Task;;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TaskExport implements FromView
{
    public function view(): View
    {
        return view('exports.tasks', [
            'tasks' => Task::all()
        ]);
    }
}

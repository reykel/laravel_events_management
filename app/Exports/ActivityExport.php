<?php

namespace App\Exports;

use App\Models\Activity;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActivityExport implements FromView
{
    public function view(): View
    {
        return view('exports.activities', [
            'activities' => Activity::all()
        ]);
    }
}

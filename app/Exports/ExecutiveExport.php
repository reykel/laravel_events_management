<?php

namespace App\Exports;

use App\Models\Executive;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExecutiveExport implements FromView
{
    public function view(): View
    {
        return view('exports.executives', [
            'executives' => Executive::all()
        ]);
    }
}

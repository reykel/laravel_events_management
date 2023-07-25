<?php

namespace App\Exports;

use App\Models\Agenda;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AgendaExport implements FromView
{
    public function view(): View
    {
        return view('exports.agendas', [
            'agendas' => Agenda::all()
        ]);
    }
}

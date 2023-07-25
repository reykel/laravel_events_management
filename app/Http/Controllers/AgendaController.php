<?php

namespace App\Http\Controllers;

use App\Exports\AgendaExport;
use App\Http\Requests\AgendaRequest;
use App\Http\Requests\DriverAgendaRequest;
use App\Http\Resources\ExecutiveResource;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\UserResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use App\Interfaces\AgendaRepositoryInterface;
use App\Mail\DriverAgendaMail;
use App\Mail\DriverTaskMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AgendaController extends Controller
{
    protected AgendaRepositoryInterface $agendaRepository;
    protected ExecutiveRepositoryInterface $executiveRepository;

    public function __construct(AgendaRepositoryInterface $agendaRepository, ExecutiveRepositoryInterface $executiveRepository)
    {
        $this->agendaRepository = $agendaRepository;
        $this->executiveRepository = $executiveRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Agenda/Index', [
            'list' => AgendaResource::arrayCollection($this->agendaRepository->getAllAgendas())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Agenda/Form', [
            'edit' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AgendaRequest $request
     * @return JsonResponse|RedirectResponse|Response
     */
    public function store(AgendaRequest $request)
    {
        $this->agendaRepository->createAgenda($request);
        return Inertia::render('Agenda/Index', [
            'list' => AgendaResource::arrayCollection($this->agendaRepository->getAllAgendas())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Inertia::render('Agenda/Show', [
            'agenda' => $this->agendaRepository->getAgendaById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id): Response
    {
        return Inertia::render('Agenda/Form', [
            'agenda' => $this->agendaRepository->getAgendaById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AgendaRequest $request
     * @param int $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function update(AgendaRequest $request, $id)
    {
        $agenda = $this->agendaRepository->updateAgenda($id, $request);
        return Inertia::render('Agenda/Index', [
            'list' => AgendaResource::arrayCollection($this->agendaRepository->getAllAgendas())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($this->agendaRepository->deleteAgenda($id))
            return redirect('/agenda/index');
    }

    /**
     *
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new AgendaExport, 'agendas.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExecutiveRequest;
use App\Http\Requests\UpdateExecutiveRequest;
use App\Http\Resources\ExecutiveResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use App\Repositories\ExecutiveRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Resources\AgendaResource;
use App\Interfaces\AgendaRepositoryInterface;

class DashboardController extends Controller
{
    /**
     * @var ExecutiveRepository
     */
    private  $executiveRepository;
    protected AgendaRepositoryInterface $agendaRepository;

    /**
     * @param ExecutiveRepository $executiveRepository
     */
    public function __construct(AgendaRepositoryInterface $agendaRepository,ExecutiveRepository $executiveRepository)
    {
        $this->executiveRepository = $executiveRepository;
        $this->agendaRepository = $agendaRepository;
    }

    public function home(): \Inertia\Response
    {
        return Inertia::render('Home', []);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Executive/Form', []);
    }

    /**
     * Display the privacy policy page.
     *
     * @return \Inertia\Response
     */
    public function policy(): \Inertia\Response
    {
        return Inertia::render('PrivacyPolicyEvents');
    }

    /**
     * Display the privacy policy page.
     *
     * @return \Inertia\Response
     */
    public function contact(): \Inertia\Response
    {
        return Inertia::render('Contact');
    }

    /**
     * Display the agenda page.
     *
     * @return \Inertia\Response
     */
    public function agenda(): \Inertia\Response
    {
        return Inertia::render('Agenda', [
            'list' => AgendaResource::arrayCollection($this->agendaRepository->getAllAgendas())
        ]);
    }
}

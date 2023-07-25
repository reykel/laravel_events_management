<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;
use App\Http\Resources\TransportationResource;
use App\Interfaces\TransportationRepositoryInterface;
use Illuminate\Http\Response;
use Inertia\Inertia;

class TransportationController extends Controller
{
    protected TransportationRepositoryInterface $transportationRepository;

    public function __construct(TransportationRepositoryInterface $transportationRepository)
    {
        $this->transportationRepository = $transportationRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Transportations', [
            'executives' => TransportationResource::arrayCollection($this->transportationRepository->getAllTransportations())
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransportationRequest $request
     * @return Response
     */
    public function store(StoreTransportationRequest $request): Response
    {
        return $this->transportationRepository->createTransportation($request);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        return $this->transportationRepository->getTransportationById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTransportationRequest $request
     * @param $id
     * @return Response
     */
    public function update(UpdateTransportationRequest $request, $id)
    {
        return $this->transportationRepository->updateTransportation($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        return $this->transportationRepository->deleteTransportation($id);
    }
}

<?php

namespace App\Interfaces;

use App\Http\Requests\StoreTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;

interface TransportationRepositoryInterface
{
    public function getAllTransportations();
    public function getTransportationById($id);
    public function deleteTransportation($id);
    public function createTransportation(StoreTransportationRequest $request);
    public function updateTransportation($id, UpdateTransportationRequest $request);
}

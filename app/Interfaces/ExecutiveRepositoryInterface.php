<?php

namespace App\Interfaces;

use App\Http\Requests\StoreExecutiveRequest;
use App\Http\Requests\UpdateExecutiveRequest;

interface ExecutiveRepositoryInterface
{
    public function getAllExecutives();
    public function getExecutiveById($id);
    public function deleteExecutive($id);
    public function createExecutive(StoreExecutiveRequest $request);
    public function updateExecutive($id, UpdateExecutiveRequest $request);
    public function sendEmail($executive);
}

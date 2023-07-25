<?php

namespace App\Interfaces;

use App\Http\Requests\ActivityRequest;
use App\Http\Requests\DriverActivityRequest;

interface ActivityRepositoryInterface
{
    public function getAllActivities();
    public function getActivityById($id);
    public function deleteActivity($id);
    public function createActivity(ActivityRequest $request);
    public function updateActivity($id, ActivityRequest $request);
    public function updateDriverActivity($id, DriverActivityRequest $request);
}

<?php

namespace App\Interfaces;

use App\Http\Requests\DriverTaskRequest;
use App\Http\Requests\TaskRequest;

interface TaskRepositoryInterface
{
    public function getAllTasks();
    public function getTaskById($id);
    public function deleteTask($id);
    public function createTask(TaskRequest $request);
    public function updateTask($id, TaskRequest $request);
    public function updateDriverTask($id, DriverTaskRequest $request);
}

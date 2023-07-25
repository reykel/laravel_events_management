<?php

namespace App\Repositories;

use App\Http\Requests\DriverTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

/**
 * Class TaskRepository.
 */
class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::all());
    }

    public function getTaskById($id): TaskResource
    {
        return new TaskResource(Task::findOrFail($id));
    }

    public function deleteTask($id)
    {
        try {
            if (Task::findOrFail($id)) {
                Task::destroy($id);
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function createTask(TaskRequest $request)
    {
        $task = Task::create([
            'date' => $request->date,
            'hour' => $request->hour,
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => $request->user,
            'executive_id' => $request->executive,
        ]);
        $task->save();

        return $task;
    }

    public function updateTask($id, TaskRequest $request)
    {
        Task::where('id', $id)->update([
            'date' => $request->date,
            'hour' => $request->hour,
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => $request->user,
            'executive_id' => $request->executive,
        ]);
        $task = Task::findOrFail($id);
        $task->save();

        return $task;
    }

    public function updateDriverTask($id, DriverTaskRequest $request)
    {
        Task::where('id', $id)->update([
            'comment' => $request->comment,
        ]);
        return Task::findOrFail($id);
    }
}

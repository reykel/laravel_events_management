<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\ExecutiveResource;
use App\Http\Resources\TaskActivityListResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Activity;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TaskActivityListController extends Controller
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository, ExecutiveRepositoryInterface $executiveRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->executiveRepository = $executiveRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $isDriver = Auth::user()?->role->name == 'Driver';
        $tasks = $isDriver ? Task::where('user_id', Auth::id())->get() : Task::all();
        $activities = $isDriver ? Activity::where('user_id', Auth::id())->get() : Activity::all();

        $task_resource = TaskActivityListResource::collection($tasks);
        $activity_resource = TaskActivityListResource::collection($activities);

        $all = collect($task_resource);
        $all = $all->merge($activity_resource);

        return Inertia::render('List', [
            'list' => $all,
            'role' => Auth::user()?->role->name
        ]);
    }
}

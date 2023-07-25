<?php

namespace App\Http\Controllers;

use App\Exports\TaskExport;
use App\Http\Requests\DriverTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\ExecutiveResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Mail\CodeMail;
use App\Mail\DriverTaskMail;
use App\Mail\ExecutiveTaskMail;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TaskController extends Controller
{
    protected TaskRepositoryInterface $taskRepository;
    protected ExecutiveRepositoryInterface $executiveRepository;

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
    public function index()
    {
        return Inertia::render('Task/Index', [
            'list' => TaskResource::arrayCollection($this->taskRepository->getAllTasks())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Task/Form', [
            'edit' => false,
            'executives' => ExecutiveResource::arrayCollection($this->executiveRepository->getAllExecutives()),
            'users' => UserResource::arrayCollection(User::where('active', true)->whereHas('role', function ($q) {
                $q->where('name', 'Driver');
            })->get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $task = $this->taskRepository->createTask($request);

        if ($task) {
            Mail::to($task->user->email)->send(new DriverTaskMail($task));
            Mail::to($task->executive->email)->send(new ExecutiveTaskMail($task));
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Task was confirmed',
                    'data' => new TaskResource($task)
                ], 200);

            return Inertia::render('Task/Index', [
                'list' => TaskResource::arrayCollection($this->taskRepository->getAllTasks())
            ])
                ->with('message', [
                    'text' => 'Task created',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem creating the task',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {
        return Inertia::render('Task/Show', [
            'task' => $this->taskRepository->getTaskById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return Inertia::render('Task/Form', [
            'task' => $this->taskRepository->getTaskById($id),
            'edit' => Auth::user()->role->name == 'Driver',
            'executives' => ExecutiveResource::arrayCollection($this->executiveRepository->getAllExecutives()),
            'users' => UserResource::arrayCollection(User::where('active', true)->whereHas('role', function ($q) {
                $q->where('name', 'Driver');
            })->get())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = $this->taskRepository->updateTask($id, $request);
        if ($task) {
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Task was updated',
                    'data' => new TaskResource($task)
                ], 200);

            return Inertia::render('Task/Index', [
                'list' => TaskResource::arrayCollection($this->taskRepository->getAllTasks())
            ])
                ->with('message', [
                    'text' => 'Task was updated',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem creating the task',
        ]);
    }

    /**
     * @param DriverTaskRequest $request
     * @param $id
     * @return JsonResponse|Redirector|RedirectResponse|Application
     */
    public function driverUpdateTask(DriverTaskRequest $request, $id): JsonResponse|Redirector|RedirectResponse|Application
    {
        $task = $this->taskRepository->updateDriverTask($id, $request);
        if ($task) {
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Task was updated',
                    'data' => new TaskResource($task)
                ], 200);

            return redirect('/driver-list')
                ->with('message', [
                    'text' => 'Task was updated',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem creating the task',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy(Request $request, $id)
    {
        $task = $this->taskRepository->deleteTask($id);
        if ($task) {
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Task was deleted'
                ], 200);

            return Inertia::render('Task/Index', [
                'list' => TaskResource::arrayCollection($this->taskRepository->getAllTasks())
            ])
                ->with('message', [
                    'text' => 'Task was deleted',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem deleting the task',
        ]);
    }

    /**
     *
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new TaskExport, 'tasks.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\ActivityExport;
use App\Http\Requests\ActivityRequest;
use App\Http\Requests\DriverActivityRequest;
use App\Http\Resources\ExecutiveResource;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\UserResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use App\Interfaces\ActivityRepositoryInterface;
use App\Mail\DriverActivityMail;
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

class ActivityController extends Controller
{
    protected ActivityRepositoryInterface $activityRepository;
    protected ExecutiveRepositoryInterface $executiveRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository, ExecutiveRepositoryInterface $executiveRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->executiveRepository = $executiveRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Activity/Index', [
            'list' => ActivityResource::arrayCollection($this->activityRepository->getAllActivities())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Activity/Form', [
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
     * @param ActivityRequest $request
     * @return JsonResponse|RedirectResponse|Response
     */
    public function store(ActivityRequest $request)
    {
        $activity = $this->activityRepository->createActivity($request);

        if ($activity) {
            Mail::to($activity->user->email)->send(new DriverActivityMail($activity));
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Activity was confirmed',
                    'data' => new ActivityResource($activity)
                ], 200);

            return Inertia::render('Activity/Index', [
                'list' => ActivityResource::arrayCollection($this->activityRepository->getAllActivities())
            ])
                ->with('message', [
                    'text' => 'Activity created',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem creating the activity',
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
        return Inertia::render('Activity/Show', [
            'activity' => $this->activityRepository->getActivityById($id)
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
        return Inertia::render('Activity/Form', [
            'activity' => $this->activityRepository->getActivityById($id),
            'executives' => ExecutiveResource::arrayCollection($this->executiveRepository->getAllExecutives()),
            'edit' => Auth::user()->role->name == 'Driver',
            'users' => UserResource::arrayCollection(User::where('active', true)->whereHas('role', function ($q) {
                $q->where('name', 'Driver');
            })->get())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ActivityRequest $request
     * @param int $id
     * @return JsonResponse|RedirectResponse|Response
     */
    public function update(ActivityRequest $request, $id)
    {
        $activity = $this->activityRepository->updateActivity($id, $request);
        if ($activity) {
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Activity was updated',
                    'data' => new ActivityResource($activity)
                ], 200);

            return Inertia::render('Activity/Index', [
                'list' => ActivityResource::arrayCollection($this->activityRepository->getAllActivities())
            ])
                ->with('message', [
                    'text' => 'Activity was updated',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem creating the activity',
        ]);
    }

    public function driverUpdateActivity(DriverActivityRequest $request, $id): JsonResponse|Response|RedirectResponse
    {
        $activity = $this->activityRepository->updateDriverActivity($id, $request);
        if ($activity) {
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Activity was updated',
                    'data' => new ActivityResource($activity)
                ], 200);

            return redirect('/driver-list')
                ->with('message', [
                    'text' => 'Activity was updated',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem creating the activity',
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
        $activity = $this->activityRepository->deleteActivity($id);
        if ($activity) {
            if ($request->wantsJson())
                return response()->json([
                    'message' => 'Activity was deleted'
                ], 200);

            return Inertia::render('Activity/Index', [
                'list' => ActivityResource::arrayCollection($this->activityRepository->getAllActivities())
            ])
                ->with('message', [
                    'text' => 'Activity was deleted',
                ]);
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem deleting the activity',
        ]);
    }

    /**
     *
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new ActivityExport, 'activities.xlsx');
    }
}

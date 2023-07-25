<?php

namespace App\Repositories;

use App\Http\Requests\ActivityRequest;
use App\Http\Requests\DriverActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ActivityRepository.
 */
class ActivityRepository implements ActivityRepositoryInterface
{
    public function getAllActivities(): AnonymousResourceCollection
    {
        return ActivityResource::collection(Activity::all());
    }

    public function getActivityById($id): ActivityResource
    {
        return new ActivityResource(Activity::findOrFail($id));
    }

    public function deleteActivity($id)
    {
        try {
            if (Activity::findOrFail($id)) {
                Activity::destroy($id);
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function createActivity(ActivityRequest $request)
    {
        $activity = Activity::create([
            'date' => $request->date,
            'hour' => $request->hour,
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => $request->user
        ]);
        $activity->save();

        return $activity;
    }

    public function updateActivity($id, ActivityRequest $request)
    {
        Activity::where('id', $id)->update([
            'date' => $request->date,
            'hour' => $request->hour,
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => $request->user
        ]);
        $activity = Activity::findOrFail($id);
        // $activity->executive()->sync(explode(',', $request->executives));

        return $activity;
    }

    public function updateDriverActivity($id, DriverActivityRequest $request)
    {
        Activity::where('id', $id)->update([
            'comment' => $request->comment,
        ]);
        $activity = Activity::findOrFail($id);
        $activity->executive()->attach($request->executives);
        // $activity->executive()->sync(explode(',', $request->executives));
        $activity->save();
        return Activity::findOrFail($id);
    }
}

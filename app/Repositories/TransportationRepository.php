<?php

namespace App\Repositories;

use App\Http\Requests\StoreTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;
use App\Http\Resources\TransportationResource;
use App\Interfaces\TransportationRepositoryInterface;
use App\Models\Transportation;
use Exception;

/**
 * Class TransportationRepository.
 */
class TransportationRepository implements TransportationRepositoryInterface
{
    public function getAllTransportations()
    {
        return TransportationResource::collection(Transportation::all());
    }

    public function getTransportationById($id)
    {
        return new TransportationResource(Transportation::findOrFail($id));
    }

    public function deleteTransportation($id)
    {
        try {
            if (transportation::findOrFail($id)) {
                transportation::destroy($id);
                return response()->json([
                    'message' => 'Transportation was deleted'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function createTransportation(StoreTransportationRequest $request)
    {
        $model = Transportation::create([
            'type' => $request->type,
            'number' => $request->number,
            'airline' => $request->airline,
            'place' => $request->place,
            'date' => $request->date
        ]);
        $model->save();

        return response()->json([
            'message' => 'Transportation was created',
            'data' => new TransportationResource($model)
        ], 200);;
    }

    public function updateTransportation($id, UpdateTransportationRequest $request)
    {
        Transportation::where('id', $id)->update([
            'type' => $request->type,
            'number' => $request->number,
            'airline' => $request->airline,
            'place' => $request->place,
            'date' => $request->date
        ]);

        return response()->json([
            'message' => 'Transportation was updated',
            'data' => new TransportationResource(Transportation::findOrFail($id))
        ], 200);
    }
}

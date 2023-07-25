<?php

namespace App\Repositories;

use App\Http\Requests\AgendaRequest;
use App\Http\Resources\AgendaResource;
use App\Interfaces\AgendaRepositoryInterface;
use App\Models\Agenda;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class AgendaRepository.
 */
class AgendaRepository implements AgendaRepositoryInterface
{
    public function getAllAgendas(): AnonymousResourceCollection
    {
        return AgendaResource::collection(Agenda::all());
    }

    public function getAgendaById($id): AgendaResource
    {
        return new AgendaResource(Agenda::findOrFail($id));
    }

    public function deleteAgenda($id)
    {
        try {
            if (Agenda::findOrFail($id)) {
                Agenda::destroy($id);
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function createAgenda(AgendaRequest $request)
    {
        $agenda = Agenda::create([
            'name' => $request->name,
            'date' => $request->date,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'comments' => $request->comments,
        ]);
        $agenda->save();

        return $agenda;
    }

    public function updateAgenda($id, AgendaRequest $request)
    {
        Agenda::where('id', $id)->update([
            'name' => $request->name,
            'date' => $request->date,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'comments' => $request->comments,
        ]);
        $agenda = Agenda::findOrFail($id);
        // $agenda->executive()->sync(explode(',', $request->executives));

        return $agenda;
    }
}

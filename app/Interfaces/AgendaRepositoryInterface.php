<?php

namespace App\Interfaces;

use App\Http\Requests\AgendaRequest;

interface AgendaRepositoryInterface
{
    public function getAllAgendas();
    public function getAgendaById($id);
    public function deleteAgenda($id);
    public function createAgenda(AgendaRequest $request);
    public function updateAgenda($id, AgendaRequest $request);
}

<?php

namespace App\Repositories;

use App\Http\Requests\StoreExecutiveRequest;
use App\Http\Requests\UpdateExecutiveRequest;
use App\Http\Resources\ExecutiveResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use App\Mail\AdminERMail;
use App\Mail\ExecutiveMail;
use App\Models\Executive;
use App\Models\Transportation;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Mail;

/**
 * Class ExecutiveRepository.
 */
class ExecutiveRepository implements ExecutiveRepositoryInterface
{
    public function getAllExecutives(): AnonymousResourceCollection
    {
        return ExecutiveResource::collection(Executive::all());
    }

    public function getExecutiveById($id): ExecutiveResource
    {
        return new ExecutiveResource(Executive::findOrFail($id));
    }

    public function deleteExecutive($id)
    {
        try {
            if (Executive::findOrFail($id)) {
                Executive::destroy($id);
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function createExecutive(StoreExecutiveRequest $request)
    {
        $arrival = Transportation::create([
            'type' => $request->arrival_type,
            'airport' => $request->arrival_airport,
            'terminal' => $request->arrival_terminal,
            'airline' => $request->arrival_airline,
            'flight_number' => $request->arrival_flight_number,
            'station' => $request->arrival_station,
            'train_number' => $request->arrival_train_number,
            'other_location' => $request->arrival_other_location,

            'date' => $request->arrival_date,
            'hotel' => $request->arrival_hotel,
            'address' => $request->arrival_address,
            'transfer' => $request->arrival_transfer,
        ]);
        $arrival->save();

        $departure = Transportation::create([
            'type' => $request->departure_type,
            'airport' => $request->departure_airport,
            'terminal' => $request->departure_terminal,
            'airline' => $request->departure_airline,
            'flight_number' => $request->departure_flight_number,
            'station' => $request->departure_station,
            'train_number' => $request->departure_train_number,
            'other_location' => $request->departure_other_location,

            'date' => $request->departure_date,
            'hotel' => $request->departure_hotel,
            'address' => $request->departure_address,
            'transfer' => $request->departure_transfer,
        ]);
        $departure->save();

        $executive = Executive::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => " " . $request->mobile,
            'phone_code' => $request->phone_code,
            'mobile_code' => $request->mobile_code,
            'nationality' => $request->nationality,
            'allergies' => $request->allergies,
            'special_needs' => $request->special_needs,
            'passport' => $request->passport,
            'company' => $request->company,
            'assist' => $request->assist
        ]);

        $executive->arrive()->associate($arrival);
        $executive->departure()->associate($departure);

        $executive->save();
        return $executive;
    }

    public function updateExecutive($id, UpdateExecutiveRequest $request): bool
    {
        try {
            $executive = Executive::find($id);
            $arrival = $executive->arrive;
            $departure = $executive->departure;

            $arrival->type = $request->arrival_type;
            $arrival->airport = $request->arrival_airport;
            $arrival->terminal = $request->arrival_terminal;
            $arrival->airline = $request->arrival_airline;
            $arrival->flight_number = $request->arrival_flight_number;
            $arrival->station = $request->arrival_station;
            $arrival->train_number = $request->arrival_train_number;
            $arrival->other_location = $request->arrival_other_location;

            $arrival->date = $request->arrival_date;
            $arrival->hotel = $request->arrival_hotel;
            $arrival->address = $request->arrival_address;
            $arrival->transfer = $request->arrival_transfer;

            $arrival->save();

            $departure->type = $request->departure_type;
            $departure->airport = $request->departure_airport;
            $departure->terminal = $request->departure_terminal;
            $departure->airline = $request->departure_airline;
            $departure->flight_number = $request->departure_flight_number;
            $departure->station = $request->departure_station;
            $departure->train_number = $request->departure_train_number;
            $departure->other_location = $request->departure_other_location;

            $departure->date = $request->departure_date;
            $departure->hotel = $request->departure_hotel;
            $departure->address = $request->departure_address;
            $departure->transfer = $request->departure_transfer;

            $departure->save();

            $executive->name = $request->name;
            $executive->last_name = $request->last_name;
            $executive->email = $request->email;
            $executive->phone = $request->phone;
            $executive->phone_code = $request->phone_code;
            $executive->mobile = $request->mobile_code . $request->mobile;
            $executive->mobile_code = $request->mobile_code;
            $executive->nationality = $request->nationality;
            $executive->allergies = $request->allergies;
            $executive->special_needs = $request->special_needs;
            $executive->passport = $request->passport;
            $executive->company = $request->company;
            $executive->assist = $request->assist;

            $executive->save();
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @param $executive
     * @return string
     */
    public function sendEmail($executive): string
    {
        $emailDetails = [
            'name' => $executive->name,
            'last_name' => $executive->last_name,
            'email' => $executive->email,
            'phone' => $executive->phone,
            'mobile' => $executive->mobile,
            'phone_code' => $executive->phone_code,
            'mobile_code' => $executive->mobile_code,
            'nationality' => $executive->nationality,
            'passport' => $executive->passport,
            'allergies' => $executive->allergies,
            'special_needs' => $executive->special_needs,
            'company' => $executive->company,
            'assist' => $executive->assist == 1 ? 'Yes' : 'No',

            'arrive_type' => $executive->arrive->type,
            'arrive_airport' => $executive->arrive->airport,
            'arrive_terminal' => $executive->arrive->terminal,
            'arrive_airline' => $executive->arrive->airline,
            'arrive_flight_number' => $executive->arrive->flight_number,
            'arrive_station' => $executive->arrive->station,
            'arrive_train_number' => $executive->arrive->train_number,
            'arrive_other_location' => $executive->arrive->other_location,
            'arrive_date' => $executive->arrive->date,
            'arrive_hotel' => $executive->arrive->hotel,
            'arrive_address' => $executive->arrive->address,
            'arrive_transfer' => $executive->arrive->transfer == 1 ? 'Yes' : 'No',

            'departure_type' => $executive->departure->type,
            'departure_airport' => $executive->departure->airport,
            'departure_terminal' => $executive->departure->terminal,
            'departure_airline' => $executive->departure->airline,
            'departure_flight_number' => $executive->departure->flight_number,
            'departure_station' => $executive->departure->station,
            'departure_train_number' => $executive->departure->train_number,
            'departure_other_location' => $executive->departure->other_location,
            'departure_date' => $executive->departure->date,
            'departure_hotel' => $executive->departure->hotel,
            'departure_address' => $executive->departure->address,
            'departure_transfer' => $executive->departure->transfer == 1 ? 'Yes' : 'No'
        ];

        try {
             Mail::to($executive->email)->send(new ExecutiveMail($emailDetails));
             Mail::to('protocolo_ib@iberdrola.es')->send(new AdminERMail($emailDetails));
             Mail::to('reinaldo.alcala@gmail.com')->send(new AdminERMail($emailDetails));
            return 'ok';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

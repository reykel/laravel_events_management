
@component('mail::message')
    Hi {{ $details['name'] }}, thank you for your registration in  {{ config('app.name') }}. Your data has been successfully saved. If you need to make changes to your information write to <protocolo_ib@iberdrola.es>.
    @component('mail::table')
        |               |               |              |
        | ------------- |:-------------:|:-------------:
        | Name:         | {{ $details['name'] }}       |  |
        | Last name:    | {{ $details['last_name'] }}  |  |
        | Email:        | {{ $details['email'] }}  |  |
        | Passport:     | {{ $details['passport'] }}   |  |
        | Phone:        | +{{ $details['phone_code'] }} {{ $details['phone'] }}      |  |
        | Mobile:       | +{{ $details['mobile_code'] }} {{ $details['mobile'] }}     |  |
        | Nationality:  | {{ $details['nationality'] }}|  |
        | Company:      | {{ $details['company'] }}|  |
        | Allergies:    | {{ $details['allergies'] }}  |  |
        | Special needs:| {{ $details['special_needs'] }}|  |
        | Assist to the social program:| {{ $details['assist'] }}|  |

    @endcomponent

Arrival data:
    @component('mail::table')
    |               |               |              |
    | ------------- |:-------------:|:-------------:
    | Type:         | {{ $details['arrive_type'] }}       |  |
    @if ($details['arrive_type']=='Airplane')
    | Airport:      | {{ $details['arrive_airport'] }}    |  |
    | Terminal:     | {{ $details['arrive_terminal'] }}   |  |
    | Airline:      | {{ $details['arrive_airline'] }}    |  |
    | Flight number:| {{ $details['arrive_flight_number'] }}|  |
    @endif
    @if ($details['arrive_type']=='Train')
    | Station:      | {{ $details['arrive_station'] }}    |  |
    | Train number: | {{ $details['arrive_train_number'] }}|  |
    @endif
    @if ($details['arrive_type']=='Others'||$details['arrive_type']=='Vehicle')
    | Other location:| {{ $details['arrive_other_location'] }}|  |
    @endif
    | Date:         | {{ $details['arrive_date'] }}       |  |
    | Hotel:        | {{ $details['arrive_hotel'] }}      |  |
    | Address:      | {{ $details['arrive_address'] }}    |  |
    | Transfer:     | {{ $details['arrive_transfer'] }}   |  |
    @endcomponent

Departure data:
    @component('mail::table')
    |               |               |              |
    | ------------- |:-------------:|:-------------:
    | Type:         | {{ $details['departure_type'] }}       |  |
    @if ($details['departure_type']=='Airplane')
    | Airport:      | {{ $details['departure_airport'] }}    |  |
    | Terminal:     | {{ $details['departure_terminal'] }}   |  |
    | Airline:      | {{ $details['departure_airline'] }}    |  |
    | Flight number:| {{ $details['departure_flight_number'] }}|  |
    @endif
    @if ($details['departure_type']=='Train')
    | Station:      | {{ $details['departure_station'] }}    |  |
    | Train number: | {{ $details['departure_train_number'] }}|  |
    @endif
    @if ($details['departure_type']=='Others'||$details['departure_type']=='Vehicle')
    | Other location:| {{ $details['departure_other_location'] }}|  |
    @endif
    | Date:         | {{ $details['departure_date'] }}       |  |
    | Hotel:        | {{ $details['departure_hotel'] }}      |  |
    | Address:      | {{ $details['departure_address'] }}    |  |
    | Transfer:     | {{ $details['departure_transfer'] }}   |  |
    @endcomponent


    {{ config('app.name') }}
@endcomponent

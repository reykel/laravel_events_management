<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Mobile</th>
        <th>Passport</th>
        <th>Nationality</th>
        <th>Company</th>
        <th>Allergies</th>
        <th>Special needs</th>
        <th>Assist to the social program</th>

        <th>Arrival Type</th>
        <th>Arrival Airport</th>
        <th>Arrival Terminal</th>
        <th>Arrival Airline</th>
        <th>Arrival Flight Number</th>
        <th>Arrival Station</th>
        <th>Arrival Train Number</th>
        <th>Arrival Date</th>
        <th>Arrival Hotel</th>
        <th>Arrival Address</th>
        <th>Arrival Transfer</th>

        <th>Departure Type</th>
        <th>Departure Airport</th>
        <th>Departure Terminal</th>
        <th>Departure Airline</th>
        <th>Departure Flight Number</th>
        <th>Departure Station</th>
        <th>Departure Train Number</th>
        <th>Departure Date</th>
        <th>Departure Hotel</th>
        <th>Departure Address</th>
        <th>Departure Transfer</th>

    </tr>
    </thead>
    <tbody>
    @foreach($executives as $executive)
        <tr>
            <td>{{ $executive->name }}</td>
            <td>{{ $executive->last_name }}</td>
            <td>{{ $executive->email }}</td>
            <td>+{{ $executive->phone_code }} {{ $executive->phone }}</td>
            <td>+{{ $executive->mobile_code }} {{ $executive->mobile }}</td>
            <td>{{ $executive->passport }}</td>
            <td>{{ $executive->nationality }}</td>
            <td>{{ $executive->company }}</td>
            <td>{{ $executive->allergies }}</td>
            <td>{{ $executive->special_needs }}</td>
            <td>@if ($executive->assist) Yes @else No @endif</td>

            <td>{{ $executive->arrive->type }}</td>
            <td>{{ $executive->arrive->airport }}</td>
            <td>{{ $executive->arrive->terminal }}</td>
            <td>{{ $executive->arrive->airline }}</td>
            <td>{{ $executive->arrive->flight_number }}</td>
            <td>{{ $executive->arrive->station }}</td>
            <td>{{ $executive->arrive->train_number }}</td>
            <td>{{ $executive->arrive->date }}</td>
            <td>{{ $executive->arrive->hotel }}</td>
            <td>{{ $executive->arrive->address }}</td>
            <td>@if ($executive->arrive->transfer) Yes @else No @endif</td>

            <td>{{ $executive->departure->type }}</td>
            <td>{{ $executive->departure->airport }}</td>
            <td>{{ $executive->departure->terminal }}</td>
            <td>{{ $executive->departure->airline }}</td>
            <td>{{ $executive->departure->flight_number }}</td>
            <td>{{ $executive->departure->station }}</td>
            <td>{{ $executive->departure->train_number }}</td>
            <td>{{ $executive->departure->date }}</td>
            <td>{{ $executive->departure->hotel }}</td>
            <td>{{ $executive->departure->address }}</td>
            <td>@if ($executive->departure->transfer) Yes @else No @endif</td>
        </tr>
    @endforeach
    </tbody>
</table>


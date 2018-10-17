@extends('main')

@section('content')
    <h1>Flight</h1>
    <table class="table">
        <tr>
            <th>Flight Number</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Seats</th>
            <th>Bookings</th>
            <th></th>
        </tr>
        <tr>
            <td>{{ $flight->id }}</td>
            <td>{{ $flight->departure }}</td>
            <td>{{ $flight->arrival }}</td>
            <td>{{ $flight->seats }}</td>
            <td>{{ count($flight->tourist) }}</td>
            <td>
                {!! Form::open(['action' => ['FlightsController@destroy', $flight->id], 'method' => 'POST']) !!}
                {{Form::hidden('flight_id', $flight->id)}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Cancel Flight', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'You are about to cancel flight. Continue ?\')'])}}
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
    @if( !count($flight->tourist) )
        <div>Flight has no bookings yet</div>
        <div><a href="{{ $flight->id }}/edit">Add Booking</a></div>
    @else
        @if( $flight->seats > count($flight->tourist) )
            <div><a href="{{ $flight->id }}/edit">Add Booking</a></div>
        @else
            <div>This flight is fully booked</div>
        @endif
        <h4>Passenger List:</h4>
        <table class="table table-striped">
            <tr>
                <th>Sex</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Date of Birth</th>
                <th></th>
            </tr>
        @foreach( $flight->tourist as $tourist )
            <tr>
                <td>{{ $tourist->sex }}</td>
                <td>{{ $tourist->name }}</td>
                <td>{{ $tourist->surname }}</td>
                <td>{{ $tourist->date_of_birth }}</td>
                <td>
                    {!! Form::open(['action' => ['FlightsController@cancelBooking', $flight->id], 'method' => 'POST']) !!}
                    {{Form::hidden('tourist_id', $tourist->id)}}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Cancel Booking', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'You are about to cancel booking. Continue ?\')'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </table>
    @endif
@endsection
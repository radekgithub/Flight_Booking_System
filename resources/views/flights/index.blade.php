@extends('main')

@section('content')
    <div><a href="flights/create">Add New Flight</a></div>
    <h1>Flights</h1>
    @if( count($flights) > 0)
        <table class="table table-striped">
            <tr>
                <th>Number</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Seats</th>
                <th>Bookings</th>
                <th></th>
            </tr>
        @foreach($flights as $flight)
            <tr>
            <td>{{ $flight->id }}</td>
            <td>{{ $flight->departure }}</td>
            <td>{{ $flight->arrival }}</td>
            <td>{{ $flight->seats }}</td>
            <td>{{ count($flight->tourist) }}</td>
            <td>
                <a href="flights/{{ $flight->id }}" class="btn btn-success">Show</a>
                <span class="btn">
                {!! Form::open(['action' => ['FlightsController@destroy', $flight->id], 'method' => 'POST']) !!}
                {{Form::hidden('flight_id', $flight->id)}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Cancel Flight', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'You are about to cancel flight. Continue ?\')'])}}
                {!! Form::close() !!}
                </span>
            </td>
            </tr></a>
        @endforeach
        </table>
        {{ $flights->links() }}
    @endif
@endsection
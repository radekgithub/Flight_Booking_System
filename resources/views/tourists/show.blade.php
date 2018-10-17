@extends('main')

@section('content')
    <h1>Tourist</h1>
    <table class="table">
        <tr>
            <th>Sex</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Country</th>
            <th>Date of Birth</th>
        </tr>
        <tr>
            <td>{{ $tourist->sex }}</td>
            <td>{{ $tourist->name }}</td>
            <td>{{ $tourist->surname }}</td>
            <td>{{ $tourist->country }}</td>
            <td>{{ date('d-m-Y', strtotime($tourist->date_of_birth)) }}</td>
            <td>
                {!! Form::open(['action' => ['TouristsController@destroy', $tourist->id], 'method' => 'POST']) !!}
                {{ Form::hidden('flight_id', $tourist->id) }}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete Tourist', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'You are about to delete tourist. Continue ?\')'])}}
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
    <div>
        <a href="/tourists/{{ $tourist->id }}/edit">Add New Booking</a>
    </div>
    @if( count($tourist->flight) )
        <h4>Booked flights:</h4>
        <table class="table table-striped table-responsive">
            <tr>
                <th>Flight Number</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th></th>
            </tr>
        @foreach( $tourist->flight as $flight )
            <tr>
                <td>{{ $flight->id }}</td>
                <td>{{ $flight->departure }}</td>
                <td>{{ $flight->arrival }}</td>
                <td>
                    {!! Form::open(['action' => ['TouristsController@cancelBooking', $tourist->id], 'method' => 'POST']) !!}
                    {{ Form::hidden('flight_id', $flight->id) }}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Cancel Booking', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'You are about to cancel booking. Continue ?\')'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </table>
    @else
        <div>{{ $tourist->surname }} has no booked flights</div>
    @endif
@endsection
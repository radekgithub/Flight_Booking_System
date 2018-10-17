@extends('main')

@section('content')
    <div>
        <a href="/tourists/{{ $tourist->id }}">Back to {{ $tourist->surname }}</a>
    </div>
    <h1>Tourist {{ $tourist->surname }}: Add New Booking</h1>
    <table class="table table-striped table-responsive">
        <tr>
            <th>Flight Number</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th></th>
        </tr>
    @foreach( $flights as $flight )
        @if( !in_array($flight->id, $booked) )
            <tr>
                <td>{{ $flight->id }}</td>
                <td>{{ $flight->departure }}</td>
                <td>{{ $flight->arrival }}</td>
                <td>
                    {!! Form::open(['action' => ['TouristsController@update', $tourist->id], 'method' => 'POST']) !!}
                    {{Form::hidden('flight_id', $flight->id)}}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Book Flight', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endif
    @endforeach
    </table>
@endsection

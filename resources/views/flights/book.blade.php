@extends('main')

@section('content')
    <div>
        <a href="/flights/{{ $flight->id }}">Back to flight {{ $flight->id }}</a>
    </div>
    <h1>Flight Number {{ $flight->id }}: Add New Booking</h1>
    <table class="table table-striped">
        <tr>
            <th>Sex</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Date of Birth</th>
            <th></th>
        </tr>
    @foreach( $tourists as $tourist )
        <tr>
            <td>{{ $tourist->sex }}</td>
            <td>{{ $tourist->name }}</td>
            <td>{{ $tourist->surname }}</td>
            <td>{{ $tourist->date_of_birth }}</td>
            <td>
                {!! Form::open(['action' => ['FlightsController@update', $flight->id], 'method' => 'POST']) !!}
                {{Form::hidden('tourist_id', $tourist->id)}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Book Flight', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </table>
@endsection

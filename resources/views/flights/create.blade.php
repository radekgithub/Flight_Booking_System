@extends('main')

@section('content')
    <div class="col-md-offset-3 col-md-6">
        <h1>Create Flight</h1>
        {!! Form::open(['action' => 'FlightsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('departure', 'Departure') }}
            {{ Form::text('departure', '', ['required', 'class' => 'timepicker form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('arrival', 'Arrival') }}
            {{ Form::text('arrival', '', ['required', 'class' => 'timepicker form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('seats', 'Seats') }}
            {{ Form::select('seats', ['4' => 4, '7' => 7, '10' => 10], null, ['required', 'class' => 'form-control', 'placeholder' => 'Choose number of seats']) }}
        </div>
        <div class="form-group">
            {{ Form::label('price', 'Price') }}
            {{ Form::number('price', null, ['required', 'min' => 0, 'max' => 400, 'step' => 10, 'class' => 'form-control']) }}
        </div>
        {{Form::submit('Create Flight', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
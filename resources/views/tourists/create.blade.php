@extends('main')

@section('content')
    <div class="col-md-offset-3 col-md-6">
        <h1>Add Tourist</h1>
        {!! Form::open(['action' => 'TouristsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['required', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('surname', 'Surname') }}
            {{ Form::text('surname', null, ['required', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('sex', 'Sex') }}
            {{ Form::select('sex', ['Ms.' => 'Ms', 'Mr.' => 'Mr'], null, ['required', 'class' => 'form-control', 'placeholder' => 'Choose sex']) }}
        </div>
        <div class="form-group">
            {{ Form::label('country', 'Country') }}
            {{ Form::select('country', ['Poland' => 'Poland', 'USA' => 'USA'], null, ['required', 'class' => 'form-control', 'placeholder' => 'Choose country']) }}
        </div>
        <div class="form-group">
            {{ Form::label('date_of_birth', 'Date of Birth') }}
            {{ Form::text('date_of_birth', null, ['required', 'id' => 'date_of_birth', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('notes', 'Notes') }}
            {{ Form::textarea('notes', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{Form::submit('Add Tourist', ['class' => 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
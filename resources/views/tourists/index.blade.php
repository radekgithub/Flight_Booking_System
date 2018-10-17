@extends('main')

@section('content')
    <a href="tourists/create">Add New Tourist</a>
    <h1>Tourists</h1>
    @if(count($tourists) > 0)
        <table class="table table-striped">
            <tr>
                <th>Sex</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Date of Birth</th>
                <th></th>
            </tr>
        @foreach($tourists as $tourist)
            <tr>
                <td>{{ $tourist->sex }}</td>
                <td>{{ $tourist->name }}</td>
                <td>{{ $tourist->surname }}</td>
                <td>{{ $tourist->date_of_birth }}</td>
                <td>
                    <a href="/tourists/{{ $tourist->id }}" class="btn btn-success">Show</a>
                    <span class="btn">
                    {!! Form::open(['action' => ['TouristsController@destroy', $tourist->id], 'method' => 'POST']) !!}
                    {{Form::hidden('tourist_id', $tourist->id)}}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete Tourist', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'You are about to delete tourist. Continue ?\')'])}}
                    {!! Form::close() !!}
                    </span>
                </td>
            </tr>
        @endforeach
        {{ $tourists->links() }}
    @endif
@endsection
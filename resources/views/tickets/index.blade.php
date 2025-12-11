@extends('layouts.main')
@section('content')
    <div>
       @foreach($tickets as $ticket)
           <div>{{$ticket->status}}</div>
       @endforeach
    </div>
@endsection

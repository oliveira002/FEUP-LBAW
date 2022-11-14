@extends('layouts.app')

@section('content')
    <div>
        @foreach($auctions as $auct)
            <p> {{$auct->name}} </p>
        @endforeach
    </div>
@endsection

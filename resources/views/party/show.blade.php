@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$party->name}}</div>

                <div class="panel-body">
                  Address: {{$party->address}} {{$party->city}} {{$party->state}}, {{$party->zip}}
                  <br>
                  Starts: {{$party->starts_at}}
                  <br>
                  Ends: {{$party->ends_at}}
                  <br>
                  Description: {{$party->description}}
                  <br>
                  Price: {{$party->price}}
                </div>
            </div>
        </div>
    </div>



@endsection

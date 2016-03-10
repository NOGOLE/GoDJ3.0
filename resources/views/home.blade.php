@extends('layouts.app')
<style>


   </style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Real-Time Requests</div>

                <div class="panel-body">
                    <canvas id="songs" width="400" height="400"></canvas>
                    <br>
                    <h2>Most Requested Song: <b id="most-requested-song"></b></h2>

                    <canvas id="moods" width="400" height="400"></canvas>
                    <br>
                    <h2>Most Requested Song: <b id="most-requested-song"></b></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Real-Time Map</div>

                <div class="panel-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('scripts.socket')
@endsection

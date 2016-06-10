@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Real-Time Requests</div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-6">
                    <canvas id="songs" width="350" height="400"></canvas>
                    <hr>
                    <h2>Most Requested Song: <b id="most-requested-song"></b></h2>
                  </div>
                  <div class="col-md-6">
                    <canvas id="moods" width="350" height="400"></canvas>
                    <hr>
                    <h2>Most Requested Mood: <b id="most-requested-mood"></b></h2>
                  </div>
                </div>

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

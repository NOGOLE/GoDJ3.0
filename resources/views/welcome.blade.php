@extends('layouts.app')

@section('content')
<script>
function sendSong(){
  var data= {
    lat: $('#song_lat').val(),
    long: $('#song_long').val(),
    title: $('#song_title').val(),
    artist: $('#song_artist').val(),
    user_id: $('#song_user_id').val()
  };
  console.log(data);
  $.post('/song-request',data,function(data, status){
    alert("\nStatus: " + status);
});
}
function sendMood(){
  var data = {
    lat: $('#mood_lat').val(),
    long: $('#mood_long').val(),
    title: $('#mood_title').val(),
    user_id: $('#mood_user_id').val()
  };
  console.log(data);
  $.post('/mood-request',data,function(data, status){
    alert("\nStatus: " + status);
});
}
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Real-Time Requests</div>

                <div class="panel-body">
                  <div class="row">
                    Try it out! Send a request to DJ Mastashake!
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
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Submit A Request</div>

                <div class="panel-body">
                  Song Request
                    <form role="form" method="post" action="/song-request">
                      <div class="form-group">
                      <input type="hidden" id="song_lat" value="" name="lat" />
                      <input type="hidden" id="song_long" value="" name="long" />
                      <input class="form-control" id="song_title" name="title" placeholder="Song Title"/>
                      <input class="form-control" id="song_artist" name="artist" placeholder="Song Artist"/>
                      <input class="form-control" id="song_user_id" name="user_id" placeholder="DJ"/>
                      <button class="btn btn-success" type="button" onclick="sendSong()">Submit</button>
                    </div>
                    </form>
                    Mood Request
                    <form role="form" method="post" action="/mood-request">
                      <div class="form-group">
                      <input type="hidden" id="mood_lat" value="" name="lat" />
                      <input type="hidden" id="mood_long" value="" name="long" />
                      <input class="form-control" id="mood_title" name="title" placeholder="Mood Title"/>
                      <input class="form-control" id="mood_user_id" name="user_id" placeholder="DJ"/>
                      <button class="btn btn-success" type="button" onclick="sendMood()">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('scripts.front-socket')
@endsection

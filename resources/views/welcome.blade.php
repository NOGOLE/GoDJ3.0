@extends('layouts.app')

@section('content')
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
                      <input class="form-control" name="title" placeholder="Song Title"/>
                      <input class="form-control" name="artist" placeholder="Song Artist"/>
                      <input class="form-control" name="user_id" placeholder="DJ"/>
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    </form>
                    Mood Request
                    <form role="form" method="post" action="/mood-request">
                      <div class="form-group">
                      <input type="hidden" id="mood_lat" value="" name="lat" />
                      <input type="hidden" id="mood_long" value="" name="long" />
                      <input class="form-control" name="title" placeholder="Mood Title"/>
                      <input class="form-control" name="user_id" placeholder="DJ"/>
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var x;
var y;

function getLocation() {
 if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(showPosition);
 } else {
     x.innerHTML = "Geolocation is not supported by this browser.";
 }
}
function showPosition(position) {

 document.getElementById('song_lat').value = position.coords.latitude;
 document.getElementById('mood_lat').value = position.coords.latitude;

 document.getElementById('song_long').value = position.coords.longitude;
document.getElementById('mood_long').value = position.coords.longitude;
}
window.onload=getLocation();
</script>
@endsection

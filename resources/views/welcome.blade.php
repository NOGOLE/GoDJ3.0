@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Submit A Request</div>

                <div class="panel-body">
                    <form role="form" method="post" action="/song-request">
                      <div class="form-group">
                      <input type="hidden" id="lat" value="" name="lat" />
                      <input type="hidden" id="long" value="" name="long" />
                      <input class="form-control" name="title" placeholder="Song Title"/>
                      <input class="form-control" name="artist" placeholder="Song Artist"/>
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
var x = document.getElementById("lat");
var y = document.getElementById("long");

function getLocation() {
 if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(showPosition);
 } else {
     x.innerHTML = "Geolocation is not supported by this browser.";
 }
}
function showPosition(position) {

 x.value = position.coords.latitude;
 y.value = position.coords.longitude;
 console.log(x);
 console.log(y);
}
window.onload=getLocation();
</script>
@endsection

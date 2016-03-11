@extends('layouts.app')

@section('content')
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
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
function getLocation() {
 if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(showPosition);
 } else {
     alert("Geolocation is not supported by this browser.");
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


<script src="bower_components/Chart.js/Chart.js"></script>
<script src="http://159.203.76.248:6001/socket.io/socket.io.js"></script>
<script>
var songData = [];
var moodData = [];
var ctx = document.getElementById("songs").getContext("2d");
var ctx2 = document.getElementById("moods").getContext("2d");
// For a pie chart
var mySongChart = new Chart(ctx).Doughnut(songData);
var myMoodChart = new Chart(ctx2).Doughnut(moodData);
  var songs = [];
  var moods = [];
  var socket = io('http://159.203.76.248:6001');
  var channel = "user.1";

  socket.on(channel, function (data) {


    switch(data.event){
      case "App\\Events\\SongRequested":

      data = data.data;
      console.log(data);
      if($.inArray(data.songRequest.title, songs) != -1){
        updateSongData(mySongChart, data, songs);
      }
      else{
        addNewSongData(songs,mySongChart,data);
      }
      break;
      case "App\\Events\\MoodRequested":
      data = data.data;
      if($.inArray(data.moodRequest.title, moods) != -1){
        updateMoodData(myMoodChart, data, moods);
      }
      else{
        addNewMoodData(moods,myMoodChart,data);
      }
      break;
    }
    /*
*/
  });

</script>
<script>
function updateSongData(mySongChart, data, songs){
  mySongChart.segments[$.inArray(data.songRequest.title, songs)].value += 1;
  mySongChart.update();
  songs.push(data.songRequest.title);
  updateMostRequestedSongs(mySongChart.segments);
}
function updateMoodData(myMoodChart, data, moods){
  console.log(myMoodChart.segments);
  myMoodChart.segments[$.inArray(data.moodRequest.title, songs)].value += 1;
  myMoodChart.update();
  moods.push(data.moodRequest.title);

  updateMostRequestedMoods(myMoodChart.segments);
}

function addNewSongData(songs,chart,data){
  var color = '#' + (function co(lor){   return (lor +=
[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
&& (lor.length == 6) ?  lor : co(lor); })('');
//console.log(color);
var highlight = '#' + (function co(lor){   return (lor +=
[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
&& (lor.length == 6) ?  lor : co(lor); })('');

  songs.push(data.songRequest.title);
  chart.addData({
value: 1,
color: color,
highlight: highlight,
label: data.songRequest.title + ' by ' + data.songRequest.artist
});

updateMostRequestedSongs(mySongChart.segments);
}

function addNewMoodData(moods,chart,data){
  var color = '#' + (function co(lor){   return (lor +=
[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
&& (lor.length == 6) ?  lor : co(lor); })('');
//console.log(color);
var highlight = '#' + (function co(lor){   return (lor +=
[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
&& (lor.length == 6) ?  lor : co(lor); })('');

  moods.push(data.moodRequest.title);
  chart.addData({
value: 1,
color: color,
highlight: highlight,
label: data.moodRequest.title
});

updateMostRequestedMoods(myMoodChart.segments);
}

function updateMostRequestedSongs(songs){
  var songValues = [];
  for(var i = 0; i<songs.length; ++i){
    songValues.push(songs[i].value);
  }
  var max = Math.max.apply(null,songValues);
  var index = songValues.indexOf(max);
  document.getElementById("most-requested-song").innerHTML = songs[index].label;
}

function updateMostRequestedMoods(moods){
  var moodValues = []
  for(var i = 0; i<moods.length; ++i){
    moodValues.push(moods[i].value);
  }
  var max = Math.max.apply(null,moodValues);
  var index = moodValues.indexOf(max);
  document.getElementById("most-requested-mood").innerHTML = moods[index].label;
}
</script>

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
@endsection


<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="bower_components/Chart.js/Chart.js"></script>
<script src="{{env('APP_URL')}}/socket.io/socket.io.js"></script>
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
  var socket = io("{{env('APP_URL')}}:3000");
  var channel = "user.{{Auth::user()->id}}";

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
  updateSongMarkers(data);
  updateMostRequestedSongs(mySongChart.segments);
}
function updateMoodData(myMoodChart, data, moods){
  myMoodChart.segments[$.inArray(data.moodRequest.title, songs)].value += 1;
  myMoodChart.update();
  moods.push(data.moodRequest.title);
  updateMoodMarkers(data);
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
updateSongMarkers(data);
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
updateMoodMarkers(data);
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
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 41.850033, lng: -87.6500523},
          zoom: 4
        });
      }
      function updateSongMarkers(data){
        var pinIcon = new google.maps.MarkerImage(
    'http://www.clker.com/cliparts/e/3/F/I/0/A/google-maps-marker-for-residencelamontagne-hi.png',
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(42, 68)
);
        var marker = new google.maps.Marker({
      position: {lat: Number(data.songRequest.lat), lng: Number(data.songRequest.long)},
      map: map,
      animation: google.maps.Animation.DROP,
      icon:pinIcon,
      title: data.songRequest.title + ' by  ' + data.songRequest.artist
    });
      }

      function updateMoodMarkers(data){
        var pinIcon = new google.maps.MarkerImage(
    'http://www.clker.com/cliparts/8/6/U/z/k/o/google-maps-marker-for-residencelamontagne-hi.png',
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(42, 68)
);
        var marker = new google.maps.Marker({
      position: {lat: Number(data.moodRequest.lat), lng: Number(data.moodRequest.long)},
      map: map,
      icon:pinIcon ,
      animation: google.maps.Animation.DROP,
      title: data.moodRequest.title
    });
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCDNt1biVyfA8h-eCZyZ69CKS6NNBCeEQ&callback=initMap"
    async defer></script>

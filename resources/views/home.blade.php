@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="bower_components/Chart.js/Chart.js"></script>
<script src="http://godj.app:6001/socket.io/socket.io.js"></script>
<script>
var pieData = [];
var ctx = document.getElementById("myChart").getContext("2d");
// For a pie chart
var myPieChart = new Chart(ctx).Doughnut(pieData);
  var songs = [];
  var socket = io('http://godj.app:6001');
  var channel = "user.{{Auth::user()->id}}";

  socket.on(channel, function (data) {
    var color = '#' + (function co(lor){   return (lor +=
[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
&& (lor.length == 6) ?  lor : co(lor); })('');
//console.log(color);
var highlight = '#' + (function co(lor){   return (lor +=
[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
&& (lor.length == 6) ?  lor : co(lor); })('');

    //songs.push(data.songRequest.title);
    //console.log(songs);

    if($.inArray(data.songRequest.title, songs) != -1){
      myPieChart.segments[$.inArray(data.songRequest.title, songs)].value += 1;
      myPieChart.update();
    }
    else{
      songs.push(data.songRequest.title);
      myPieChart.addData({
    value: 1,
    color: color,
    highlight: highlight,
    label: data.songRequest.title
});
    }



  });

</script>
@endsection

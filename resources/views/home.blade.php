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

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Your Parties</div>

                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (Auth::user()->parties as $party)
                          <tr>
                            <td>{{ $party->name }}</td> $judgment->price/100)}}</td>
                            <td>
                              <button class="btn btn-warning btn-color btn-bg-color btn-md col-lg-12 btn-primary-spacing" data-toggle="modal" data-target="#{{ $party->id }}_edit"><i class="fa fa-edit"></i> Edit Party </button>

                              <!-- Modal -->
                              <div class="modal fade" id="{{ $party->id }}_edit" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Edit Party: {{$party->name}}</h4>
                                    </div>
                                    <form role="form">
                                    <textarea type="textarea" class="form-control" name="contact_seller_msg" placeholder="Message To Seller"></textarea>
                                  </form>
                                    <div class="modal-footer">
                                      <button type="submit" id="{{ $judgment->metadata->casenum }}-submit-offer" class="btn btn-default" data-dismiss="modal">Submit</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <script>
                              $("#{{ $judgment->metadata->casenum }}-submit-offer").click(function () {
                                var amount = $('#offer_amount').val();
                                var data = {amount:amount,account_id: {{$judgment->metadata->account_id}}};
                                $.post('/judgments/send-offer', data, function(data, status){
                                  console.log(data);
                                      alert('Offer Sent!');
                              });
                            });
                              </script>
                            </td>
                          </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>

                </div>
            </div>
        </div>
    </div>

</div>
@include('scripts.socket')
@endsection

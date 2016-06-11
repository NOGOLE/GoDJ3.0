@extends('layouts.app')
@section('content')
<div class="table-responsive">
<script src="https://checkout.stripe.com/checkout.js"></script>
<table class="table table-striped">
  <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Address</th>
    <th>City</th>
    <th>State</th>
    <th>ZIP</th>
    <th>Starts</th>
    <th>Ends</th>
    <th>Price</th>
    <th>Actions</th>
  </tr>
  @foreach($parties as $party)
  <tr>

        <td>{{$party->name}}</td>
        <td> {{$party->description}}</td>
        <td>{{$party->address}}</td>
        <td>{{$party->city}}</td>
        <td>{{$party->state}}</td>
        <td>{{$party->zip}}</td>
        <td>{{$party->starts_at->toDayDateTimeString()}}</td>
        <td>{{$party->ends_at->toDayDateTimeString()}}</td>
        <td>${{$party->price}}</td>
        <td>
          <button class="btn btn-success" id="customButton{{$party->id}}"><i class="fa fa-dollar fa-lg"></i> Purchase</button>

<script>

  $('#customButton{{$party->id}}').on('click', function(e) {
    var ans = prompt('How Many Tickets?');
    if(ans != '' && ans >= 1){
      var handler = StripeCheckout.configure({
        key: 'pk_test_QgdJSyRF8v7QJVM4mudy99XN',
        image: '/images/background.jpg',
        locale: 'auto',
        token: function(token) {
          // You can access the token ID with `token.id`.
          // Get the token ID to your server-side code for use.
          var data = {token: token.id, email: token.email, party_id: {{$party->id}}, amount: ans};
          console.log(data);
          $.post('/buy-tickets', data, function(){
            alert('Order Complete!');
          });
        }
      });
      // Open Checkout with further options:
      handler.open({
        name: 'GoDJ',
        description: ans +' Ticket(s) To {{$party->name}}',
        amount: ans * {{$party->price}} * 100
      });
    }
    else{
      alert('You need to order at least 1 ticket!')
    }
    e.preventDefault();
  });



  // Close Checkout on page navigation:
  $(window).on('popstate', function() {
    handler.close();
  });
</script>
        </td>

  </tr>
  @endforeach
</table>
</div>

  {!! $parties->render() !!}


@endsection

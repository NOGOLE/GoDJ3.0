<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use App\Http\Requests;
use App\Events\TicketPurchased;
class PartyController extends Controller
{

    public function __construct(){
      //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $parties = Party::simplePaginate(15);
        return view('party.index')->with(['parties' => $parties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('party.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return Party::Create([
          'name' => $request->name,
          'description' => $request->description,
          'address' => $request->address,
          'city' => $request->city,
          'state' => $request->state,
          'zip' => $request->zip,
          'price' => $request->price,
          'starts_at' => $request->start_date.'T'.$request->start_time,
          'ends_at' => $request->end_date.'T'.$request->end_time,
          'user_id' => $request->user()->id,
          ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        //
        return view('party.show')->with(['party' => $party]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
        //
        return view('party.edit')->with(['party' => $party]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Party $party)
    {
        //
        $party->fill($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Party $party)
    {
        //
        $party->delete();
    }

    /**
     * Charge card for tickets and send an email receipt
     */

     public function buyTickets(Request $request){
       // Set your secret key: remember to change this to your live secret key in production
      // See your keys here https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

      // Get the credit card details submitted by the form
      $token = $request->token;
      $party = Party::find($request->party_id);
      $total = $request->amount * $party->price * 100;

      // Create the charge on Stripe's servers - this will charge the user's card
      try {
        $charge = \Stripe\Charge::create(array(
          "amount" => $total, // amount in cents, again
          "currency" => "usd",
          "source" => $token,
          "description" => "{$party->amount} ticket(s) to {$party->name}"
          ));
           event(new TicketPurchased($request));

      } catch(\Stripe\Error\Card $e) {
        // The card has been declined
      }
           }
}

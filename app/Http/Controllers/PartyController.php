<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use App\Http\Requests;

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
}

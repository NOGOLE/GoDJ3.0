<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SongRequest;
use App\Http\Requests;
use Auth;
use Log;
class SongRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return Auth::user()->songRequests;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
        Log::info('Info',$request->all());
        $user = \App\User::where('name', $request->user_id)->first();
        //dd($user);
        $songRequest = SongRequest::Create([
          'user_id' => $user->id,
          'title' => $request->title,
          'artist' => $request->artist,
          'lat' => $request->lat,
          'long'=> $request->long,
          ]);
        if($songRequest){
          return response()->json([
            'success' => true
            ]);
        }
        else{
          return response()->json([
            'success' => false
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace FilmFest\Http\Controllers;

use FilmFest\Http\Requests\Channels\UpdateChannelRequest;
use FilmFest\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller {

    public function __construct() {
        // if a user who is not logged in tries to make admin changes, redirect them to the login page
        $this->middleware(['auth'])->only('update');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel) {
        return view('channels.show', compact('channel'));
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
    public function update(UpdateChannelRequest $request, Channel $channel) {
        
        // upload the image using the Spatie/laravel-medialibrary pkg
        if($request->hasFile('image')) {

            // clear the images from this collection then upload a new one
            $channel->clearMediaCollection('images');

            // upload new image
            $channel->addMediaFromRequest('image')->toMediaCollection('images');
        }


        $channel->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);



        return redirect()->back();

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

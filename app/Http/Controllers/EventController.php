<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('owner')
            ->orderByDesc('id')
            ->get();

        return response($events, 200);
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
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'start_at' => 'required|string',
            'end_at' => 'required|string',
            'description' => 'required|string',
        ]);
    
        $event = auth()->user()
            ->events()
            ->create($data);
    
        $event->load('owner');
    
        return response($event, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'start_at' => 'required|string',
            'end_at' => 'required|string',
            'description' => 'required|string',
        ]);
    
        $event->name = $data['name'];
        $event->location = $data['location'];
        $event->start_at = $data['start_at'];
        $event->end_at = $data['end_at'];
        $event->description = $data['description'];
    
        $event->save();
    
        $event->load('owner');
    
        return response($event, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response( null,204);
        }
}

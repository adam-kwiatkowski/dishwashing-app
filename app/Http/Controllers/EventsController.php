<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Validator;

class EventsController extends Controller
{
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Log::channel('stderr')->info('EventsController@store');
        Log::channel('stderr')->info($request->all());
        $request->validate([
            'event_type_id'=>'required|exists:event_types,id',
            'utensils'=>'required|array',
            'utensils.*.id'=>'required|exists:utensils,id',
            'utensils.*.used'=>'required|integer|min:1',
        ]);
        Log::channel('stderr')->info('EventsController@store: validation passed');

        $event = Event::create([
            'event_type_id'=>$request->event_type_id,
            'user_id'=>auth()->id(),
        ]);

        foreach ($request->utensils as $utensil) {
            $event->details()->create([
                'utensil_id'=>$utensil['id'],
                'amount'=>$utensil['used'],
            ]);
        }

        return Redirect::route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}

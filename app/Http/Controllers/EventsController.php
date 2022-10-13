<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Utensil;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::Render('Dishwashing', [
            'utensils' => Utensil::whereRelation('latest_event.event_type', 'name', 'used')->get(),
            'events' => EventResource::collection(
                Event::with('user', 'event_type', 'utensil')
                    ->orderBy('id', 'desc')
                    ->get()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => 'required|exists:event_types,id',
            'utensils' => 'required|array',
            'utensils.*.id' => 'required|exists:utensils,id',
            'utensils.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->utensils as $data) {
            Event::create([
                'amount' => $data['quantity'],
                'user_id' => auth()->id(),
                'utensil_id' => $data['id'],
                'event_type_id' => $request->event_type_id,
            ]);
        }

        return Redirect::route('events.index');
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
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}

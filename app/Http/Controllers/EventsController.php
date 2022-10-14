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

    public function use(Request $request): RedirectResponse
    {
        $request->validate([
            'utensils' => 'required|array',
            'utensils.*.id' => 'required|exists:utensils,id',
            'utensils.*.quantity' => 'required|integer|min:1',
        ]);

        $eventType = EventType::where('name', 'used')->first();

        foreach ($request->utensils as $data) {
            $utensil = Utensil::find($data['id']);
            $quantity = $data['quantity'];

            if ($utensil->available >= $quantity) {
                $utensil->available -= $quantity;
                $utensil->save();
                Event::create([
                    'amount' => $quantity,
                    'user_id' => auth()->id(),
                    'utensil_id' => $data['id'],
                    'event_type_id' => $eventType->id,
                ]);
            }
        }

        return Redirect::route('events.index');
    }

    public function wash(Request $request): RedirectResponse
    {
        $request->validate([
            'utensils' => 'required|array',
            'utensils.*.id' => 'required|exists:utensils,id',
            'utensils.*.quantity' => 'required|integer|min:1',
        ]);

        $eventType = EventType::where('name', 'washed')->first();

        foreach ($request->utensils as $data) {
            $utensil = Utensil::find($data['id']);
            $quantity = $data['quantity'];

            if ($utensil->total_amount <= $quantity + $utensil->available) {
                $utensil->available += $quantity;
                $utensil->save();
                Event::create([
                    'amount' => $quantity,
                    'user_id' => auth()->id(),
                    'utensil_id' => $data['id'],
                    'event_type_id' => $eventType->id,
                ]);
            }
        }

        return Redirect::route('events.index');
    }
}

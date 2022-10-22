<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventDetailsResource;
use App\Models\Event;
use App\Models\EventDetails;
use App\Models\EventType;
use App\Models\Utensil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class EventsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param Request $request
   * @return AnonymousResourceCollection|Response
   */
  public function index(Request $request): AnonymousResourceCollection|Response
  {
    $events = EventDetailsResource::collection(EventDetails::with('utensil', 'event', 'event.event_type', 'event.user')
      ->orderBy('id', 'desc')
      ->paginate());

    if ($request->wantsJson())
      return $events;

    return Inertia::render('Dishwashing', [
      'utensils' => Utensil::whereColumn('available', '<', 'total_amount')->get(),
      'events' => $events,
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
    $event = Event::create([
      'user_id' => auth()->id(),
      'event_type_id' => $eventType->id,
    ]);

    foreach ($request->utensils as $data) {
      $utensil = Utensil::find($data['id']);
      $quantity = $data['quantity'];

      if ($utensil->available >= $quantity) {
        $utensil->available -= $quantity;
        $utensil->save();
        $event->details()->create([
          'utensil_id' => $utensil->id,
          'amount' => $quantity,
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
    $event = Event::create([
      'user_id' => auth()->id(),
      'event_type_id' => $eventType->id,
    ]);

    foreach ($request->utensils as $data) {
      $utensil = Utensil::find($data['id']);
      $quantity = $data['quantity'];

      if ($quantity + $utensil->available <= $utensil->total_amount) {
        $utensil->available += $quantity;
        $utensil->save();
        $event->details()->create([
          'utensil_id' => $utensil->id,
          'amount' => $quantity,
        ]);
      }
    }

    return Redirect::route('events.index');
  }
}

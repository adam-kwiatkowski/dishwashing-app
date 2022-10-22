<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
  public function index(): Response
  {
    $events = Event::with('user', 'event_type', 'details')->get();

    return Inertia::render('Dashboard', [
      'stats' => [
        'your' => EventResource::collection(
          $events->where('user_id', auth()->id())
        )->collection->groupBy('event_type.name'),
        'all' => EventResource::collection(
          $events
        )->collection->groupBy('event_type.name'),
      ]
    ]);
  }
}

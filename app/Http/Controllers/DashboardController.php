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
    return Inertia::render('Dashboard', [
      'stats' => [
        'your' => [
          'washed' => EventResource::collection(
            Event::with('user', 'event_type', 'utensil')
              ->where('user_id', auth()->id())
              ->whereRelation('event_type', 'name', 'washed')
              ->get(),
          ),
          'used' => EventResource::collection(
            Event::with('user', 'event_type', 'utensil')
              ->where('user_id', auth()->id())
              ->whereRelation('event_type', 'name', 'used')
              ->get(),
          ),
        ],
        'all' => [
          'washed' => EventResource::collection(
            Event::with('user', 'event_type', 'utensil')
              ->whereRelation('event_type', 'name', 'washed')
              ->get()),
          'used' => EventResource::collection(
            Event::with('user', 'event_type', 'utensil')
              ->whereRelation('event_type', 'name', 'used')
              ->get()),
        ],
      ]
    ]);
  }
}

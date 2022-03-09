<?php

namespace App\Http\Controllers;

use App\Models\Utensil;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class DishwashingController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->join('users', 'users.id', '=', 'events.user_id')
        ->join('utensils', 'utensils.id', '=', 'events.utensil_id')
        ->select('events.*', 'users.name as user_name', 'utensils.name as utensil_name')->paginate(14);
        
        foreach ($events as $event) {
            $event->created_at_string = $event->created_at->diffForHumans();
        }    

        return Inertia::render('Dishwashing', [
            'utensils' => fn () => Utensil::addSelect(['last_action'=>Event::select('type')
                ->whereColumn('utensil_id', 'utensils.id')
                ->orderByDesc('created_at')
                ->limit(1)
            ])->get()->where('last_action', '=', 'used'),
            'events' => $events,
        ]);
    }
}

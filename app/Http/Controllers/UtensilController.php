<?php

namespace App\Http\Controllers;

use App\Models\Utensil;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class UtensilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Utensils', [
            'utensils' => Utensil::paginate(14),
        ]);
    }

    public function useUtensils(Request $request)
    {
        $utensils = $request->utensils;
        $user = auth()->user();
        foreach ($utensils as $utensil) {
            $dbUtensil = Utensil::find($utensil['id']);
            $dbUtensil->used = $dbUtensil->used + $utensil['used'];
            $dbUtensil->save();

            Event::create([
                'user_id' => $user->id,
                'utensil_id' => $utensil['id'],
                'type' => 'used',
                'quantity' => $utensil['used'],
            ]);
        }

        return Redirect::route('utensils.index');
    }

    public function washUtensils(Request $request)
    {
        $utensils = $request->utensils;
        $user = auth()->user();
        foreach ($utensils as $utensil) {
            $dbUtensil = Utensil::find($utensil['id']);
            $dbUtensil->used = 0;
            $dbUtensil->save();

            Event::create([
                'user_id' => $user->id,
                'utensil_id' => $utensil['id'],
                'type' => 'washed',
                'quantity' => $utensil['used'],
            ]);
        }

        return Redirect::route('dishwashing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('CreateUtensil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        Utensil::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);

        return Redirect::route('utensils.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utensil  $utensil
     * @return \Illuminate\Http\Response
     */
    public function show(Utensil $utensil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utensil  $utensil
     * @return \Illuminate\Http\Response
     */
    public function edit(Utensil $utensil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utensil  $utensil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utensil $utensil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utensil  $utensil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utensil $utensil)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Utensil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UtensilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Utensil::paginate(14);
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
            'name' => 'required|string',
            'quantity' => 'integer',
        ]);

        $utensil = Utensil::create($request->all());

        return $utensil;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utensil  $utensil
     * @return \Illuminate\Http\Response
     */
    public function show(Utensil $utensil)
    {
        return $utensil;
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
        $request->validate([
            'name' => 'string',
            'quantity' => 'integer',
        ]);

        $utensil->update($request->all());

        return $utensil;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utensil  $utensil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utensil $utensil)
    {
        $utensil->delete();

        return response()->json(null, 204);
    }
}

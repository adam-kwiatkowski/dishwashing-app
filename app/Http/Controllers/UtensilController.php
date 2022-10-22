<?php

namespace App\Http\Controllers;

use App\Models\Utensil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class UtensilController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(): Response
  {
    return Inertia::render('Utensils', [
      'utensils' => Utensil::paginate(14),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'total_amount' => 'required|integer|min:1',
    ]);

    if (isset($request->photo)) {
      $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
      ]);

      $image_path = $request->photo->store('public/utensils');
      $image_url = Storage::url($image_path);
    } else {
      $image_url = null;
    }

    Utensil::create([
      'name' => $request->name,
      'total_amount' => $request->total_amount,
      'available' => $request->total_amount,
      'image_url' => $image_url,
    ]);

    return Redirect::route('utensils.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(): Response
  {
    return Inertia::render('CreateUtensil');
  }

  public function show(Utensil $utensil)
  {
    return $utensil->latest_event()->get();
  }
}

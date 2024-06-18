<?php

namespace App\Http\Controllers;

use App\Models\General;

class GeneralController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  function index()
  {
    $location = General::where('key', 'location')->first();
    if (!$location) {
      $location =   General::create([
        'key' => 'location',
        'value' => json_encode([
          'latitude' => 0,
          'longitude' => 0
        ])
      ]);
    }

    $location->value = json_decode($location->value);
    return view('general.index', [
      'location' => $location
    ]);
  }

  function update_location()
  {
    $location = General::where('key', 'location')->first();
    $location->value = json_encode([
      'latitude' => request('latitude'),
      'longitude' => request('longitude')
    ]);

    $location->save();
    return redirect()->route('general.index')->with('status', 'success')->with('message', 'Location updated successfully');
  }
}

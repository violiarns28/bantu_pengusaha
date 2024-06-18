<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\General;

class GeneralController extends Controller
{

  public function  location()
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

    return response()->json([
      'success' => true,
      'message' => 'Location found',
      'data' => $location
    ], 200, [], JSON_NUMERIC_CHECK);
  }
}

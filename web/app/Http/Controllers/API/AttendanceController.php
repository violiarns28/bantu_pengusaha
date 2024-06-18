<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;


date_default_timezone_set("Asia/Jakarta");

class AttendanceController extends Controller
{
  function index()
  {
    $attendances = Attendance::where('user_id', Auth::user()->id)->get();

    if ($attendances->isEmpty()) {
      return response()->json([
        'success' => false,
        'message' => 'No attendance data',
        'data' => null
      ]);
    } else {
      return response()->json([
        'success' => true,
        'message' => 'Attendance data found',
        'data' => $attendances
      ], 200, [], JSON_NUMERIC_CHECK);
    }
  }

  function create(Request $request)
  {
    $user = Auth::user();
    if ($user->mac_address !== $request->mac_address) {
      return response()->json([
        'success' => false,
        'message' => 'Unauthorized device',
      ]);
    }

    $attendance = Attendance::whereDate('date', '=', date('Y-m-d'))
      ->where('user_id', $user->id)
      ->first();
    if ($attendance == null) {
      $attendance = Attendance::create([
        'user_id' => $user->id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'date' => date('Y-m-d'),
        'clock_in' => date('H:i:s'),
        'clock_out' => null
      ]);
      return response()->json([
        'success' => true,
        'message' => 'Clock in successful',
        'data' =>
        $attendance
      ], 200, [], JSON_NUMERIC_CHECK);
    } else {
      if ($attendance->clock_out !== null) {
        return response()->json([
          'success' => false,
          'message' => "You've already presence today",
        ]);
      } else {
        $attendance->update([
          'clock_out' => date('H:i:s')
        ]);
      }
      $attendance = Attendance::whereDate('date', '=', date('Y-m-d'))->where('user_id', $user->id)->first();
      return response()->json([
        'success' => true,
        'message' => 'Clock out successful',
        'data' =>
        $attendance
      ], 200, [], JSON_NUMERIC_CHECK);
    }
  }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class ReportController extends Controller
{

  public function index()
  {
    $users = User::with('attendances')->get();

    foreach ($users as $user) {
      $totalHours = 0;
      $totalDay = 0;
      $totalOvertime = 0;
      $totalDayOff = 0;

      foreach ($user->attendances as $attendance) {
        if ($attendance->clock_in && $attendance->clock_out) {
          $totalHours += (strtotime($attendance->clock_out) - strtotime($attendance->clock_in)) / 3600;
          $totalDay++;

          if (strtotime($attendance->clock_out) - strtotime($attendance->clock_in) > 8 * 60 * 60) {
            $totalOvertime += strtotime($attendance->clock_out) - strtotime($attendance->clock_in) - 8 * 60 * 60;
          }
        } else {
          $totalDayOff++;
        }
      }

      $user->totalHours = number_format($totalHours, 2);
      $user->totalDay = $totalDay;
      $user->totalOvertime = $totalOvertime;
      $user->totalDayOff = $totalDayOff;
    }

    if ($users->isEmpty()) {
      return response()->json([
        'success' => false,
        'message' => 'No report data found',
        'data' => null
      ]);
    } else {
      return response()->json([
        'success' => true,
        'message' => 'Report data found',
        'data' => $users
      ], 200, [], JSON_NUMERIC_CHECK);
    }
  }

  public function get_data_by_date_range()
  {
    $start_date = request('start_date');
    $end_date = request('end_date') ?? date('Y-m-d');

    $users = User::with('attendances')
      ->whereHas('attendances', function ($query) use ($start_date, $end_date) {
        $query->whereBetween('date', [$start_date, $end_date]);
      })
      ->get();

    foreach ($users as $user) {
      $totalHours = 0;
      $totalDay = 0;
      $totalOvertime = 0;
      $totalDayOff = 0;

      foreach ($user->attendances as $attendance) {
        if ($attendance->clock_in && $attendance->clock_out) {
          $totalHours += (strtotime($attendance->clock_out) - strtotime($attendance->clock_in)) / 3600;
          $totalDay++;

          if (strtotime($attendance->clock_out) - strtotime($attendance->clock_in) > 8 * 60 * 60) {
            $totalOvertime += strtotime($attendance->clock_out) - strtotime($attendance->clock_in) - 8 * 60 * 60;
          }
        } else {
          $totalDayOff++;
        }
      }

      $user->totalHours = number_format($totalHours, 2);
      $user->totalDay = $totalDay;
      $user->totalOvertime = $totalOvertime;
      $user->totalDayOff = $totalDayOff;
    }

    if ($users->isEmpty()) {
      return response()->json([
        'success' => false,
        'message' => 'No report data found',
        'data' => null
      ]);
    } else {
      return response()->json([
        'success' => true,
        'message' => 'Report data found',
        'data' => $users
      ], 200, [], JSON_NUMERIC_CHECK);
    }
  }
}

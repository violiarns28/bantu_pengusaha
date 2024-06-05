<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $users = User::with('attendances')->get();

        // summarize of total hours worked, total days worked, total overtime, and total day off

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

            $user->totalHours = $totalHours;
            $user->totalDay = $totalDay;
            $user->totalOvertime = $totalOvertime;
            $user->totalDayOff = $totalDayOff;
        }

        return view('report/index', [
            'users' => $users
        ]);
    }
}

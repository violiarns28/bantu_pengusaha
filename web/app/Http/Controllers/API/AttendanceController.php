<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Auth;
use Carbon\Carbon;
use DB;
use stdClass;

date_default_timezone_set("Asia/Jakarta");

class AttendanceController extends Controller
{
    function getAttendances()
    {
        $attendances = Attendance::where('user_id', Auth::user()->id)->get(); 
        return response()->json([
            'success' => true,
            'message' => 'Successful show data',
            'data' => $attendances
        ]);
    }

    function saveAttendance(Request $request)
    {
        $information = "";
        $attendance = Attendance::whereDate('date', '=', date('Y-m-d'))
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($attendance == null) {
            $attendance = Attendance::create([
                'user_id' => Auth::user()->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date' => date('Y-m-d'),
                'clock_in' => date('H:i:s'),
                'clock_out' => null
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Clock in successful',
                'data' => $attendance
            ]);
        } else {
            if ($attendance->clock_out !== null) {
                $information = "You've already presence today";
                return response()->json([
                    'success' => false,
                    'message' => $information,
                    'data' => null
                ]);
            } else {
                $attendance->update([
                    'clock_out' => date('H:i:s')
                ]);
            }
            $attendance = Attendance::whereDate('date', '=', date('Y-m-d'))
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Clock out successful',
                'data' => $attendance
            ]);
        }
    }
}

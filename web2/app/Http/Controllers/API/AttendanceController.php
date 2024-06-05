<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRISPresensi;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set("Asia/Jakarta");

class AttendanceController extends Controller
{
    function index()
    {
        $attendances = HRISPresensi::where('nomor_user', Auth::user()->id)->get();

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
        $information = "";
        $attendance = HRISPresensi::whereDate('tanggal', '=', date('Y-m-d'))
            ->where('nomor_user', Auth::user()->id)
            ->first();
        if ($attendance == null) {
            $attendance = HRISPresensi::create([
                'nomor_user' => Auth::user()->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'tanggal' => date('Y-m-d'),
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
                $information = "You've already presence today";
                return response()->json([
                    'success' => false,
                    'message' => $information,
                ]);
            } else {
                $attendance->update([
                    'clock_out' => date('H:i:s')
                ]);
            }
            $attendance = HRISPresensi::whereDate('tanggal', '=', date('Y-m-d'))->where('nomor_user', Auth::user()->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'Clock out successful',
                'data' =>
                $attendance
            ], 200, [], JSON_NUMERIC_CHECK);
        }
    }
}

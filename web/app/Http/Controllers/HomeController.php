<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $attendances = Attendance::select('attendances.*', 'users.name')
      ->join('users', 'attendances.user_id', '=', 'users.id')
      ->orderBy('date', 'desc')
      ->get();
    foreach ($attendances as $item) {
      $datetime = Carbon::parse($item->date)->locale('id');

      $datetime->settings(['formatFunction' => 'translatedFormat']);

      $item->date = $datetime->format('l, j F Y');
    }
    return view('home', [
      'attendances' => $attendances
    ]);
  }

  public function presence()
  {
    $user = Auth::user();
    $attendance = Attendance::whereDate('date', '=', date('Y-m-d'))
      ->where('user_id', $user->id)
      ->first();
    if ($attendance == null) {
      $attendance = Attendance::create([
        'user_id' => $user->id,
        'latitude' => '0.0',
        'longitude' => '0.0',
        'date' => date('Y-m-d'),
        'clock_in' => date('H:i:s'),
        'clock_out' => null
      ]);
      return redirect()->route('home')->with('status', 'success')->with('message', 'Clock in successful');
    } else {
      if ($attendance->clock_out == null) {
        $attendance->clock_out = date('H:i:s');
        $attendance->save();
        return redirect()->route('home')->with('status', 'success')->with('message', 'Clock out successful');
      } else {
        return redirect()->route('home')->with('status', 'error')->with('message', 'You\'ve already presence today');
      }
    }

    return redirect()->route('home')->with('status', 'error')->with('message', 'Something went wrong');
  }
}

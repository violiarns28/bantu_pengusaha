<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

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
}

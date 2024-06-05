<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRISKodePresensi;
use Illuminate\Support\Facades\DB;

class KodePresensiController extends Controller
{
    public function getonekodepresensidata($kode)
    {
        $data = HRISKodePresensi::where('kode_presensi', $kode)->get();
        return response()->json($data);
    }

}

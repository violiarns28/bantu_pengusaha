<?php

namespace App\Http\Controllers;

use App\Models\HRISSchedule;
use App\Models\HRISLembur;
use App\Models\HRISPengajuan;
use App\Models\HRISRekapPresensi;
use App\Models\HRISKodePresensi;
use App\Models\HRISGlobalLock;
use App\Models\SiteAccess;
use App\Models\SystemParameter;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\loggingTrait;
use Carbon\Carbon;

class RekapPresensiController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        // $route = '/masterSchedule';
        // $menu_id = Menu::where('route_menu', $route)->first()->id;
        // $this->authorize('view', Menu::find($menu_id));

        // ##DATA PERMISSION
        $user_id = session()->get('id');
        $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

        $list_site_id = array();

        foreach($access_site as $as){
            array_push($list_site_id, $as->site_id);
        }
        // ##END DATA PERMISSION

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Membuat objek Carbon untuk tanggal 1 bulan ini
        $date = Carbon::create($currentYear, $currentMonth, 1, 0, 0, 0);

        // Mendapatkan tanggal awal bulan
        $firstDay = $currentYear.'-'.$currentMonth.'-01';

        // Mendapatkan tanggal akhir bulan
        $lastDay = $date->endOfMonth();

        if ($from_date == null){
            $from_date = $firstDay;
        }

        if ($to_date == null){
            $to_date = $lastDay->format('Y-m-d');
        }

        $listrekap = HRISRekapPresensi::all();
        $listuser = User::whereIn('site_id', $list_site_id)->get();

        return view('hris.rekap_presensi.rekap')
        ->with(compact('listuser'))
        ->with(compact('listrekap'))
        ->with(compact('from_date'))
        ->with(compact('to_date'));
    }

    public function test(Request $request){
        // ##DATA PERMISSION
       $user_id = session()->get('id');
       $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

       $list_site_id = array();

       foreach($access_site as $as){
           array_push($list_site_id, $as->site_id);
       }

        $firstQuery = HRISPengajuan::join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
        ->where('hris_pengajuan.status_approve','=',0)
        ->whereIn('beone_users.site_id', $list_site_id)
        ->select('beone_users.nama as nama',
                    'hris_pengajuan.nomor_user',
                    'hris_pengajuan.jenis_pengajuan',
                    'hris_pengajuan.tanggal',
                    'hris_pengajuan.tanggal2',
                    'hris_pengajuan.waktu',
                    DB::raw('NULL AS waktu2'),
                    'hris_pengajuan.keterangan',
                    'hris_pengajuan.id'
    );

        $secondQuery = HRISLembur::join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
        ->where('hris_lembur.status_approve','=',0)
        ->whereIn('beone_users.site_id', $list_site_id)
        ->select('beone_users.nama as nama',
                    'hris_lembur.nomor_user',
                    'hris_lembur.jenis_pengajuan',
                    'hris_lembur.tanggal',
                    DB::raw('NULL AS tanggal2'),
                    'hris_lembur.waktu', 
                    'hris_lembur.waktu2',
                    'hris_lembur.keterangan',
                    'hris_lembur.id'
    );

    $results = $firstQuery->union($secondQuery)->get();

        return $results;
    }

    public function getonerekapdata($id)
    {
        // $data = HRISSchedule::where('id', $id)->get();
        $data = HRISRekapPresensi::where('hris_rekap_presensi.id',$id)
                                    ->join('beone_users','beone_users.nomor','=','hris_rekap_presensi.nomor_user')
                                    ->select('hris_rekap_presensi.*', 'beone_users.nama')
                                    ->get();
        return response()->json($data);
    }

    public function calcrekap(Request $request)
    {
        DB::beginTransaction();
        try {
            // $route = '/masterSchedule';
            // $menu_id = Menu::where('route_menu', $route)->first()->id;
            // $this->authorize('create', Menu::find($menu_id));


            $from_date = $request->input('from_date_rekap');
            $to_date = $request->input('to_date_rekap');

            $schedules = HRISSchedule::whereBetween('hris_schedule.tanggal', [$from_date, $to_date])
                                ->leftjoin('hris_presensi', function ($join) {
                                $join->on('hris_presensi.nomor_user', '=', 'hris_schedule.nomor_user')
                                         ->on('hris_presensi.tanggal', '=', 'hris_schedule.tanggal');
                                })
                                ->select('hris_schedule.*', 'hris_presensi.clock_in as presensi_clock_in', 'hris_presensi.clock_out as presensi_clock_out')
                                ->get();
            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();

            if ($from_date > $to_date){
                $message = 'To Date tidak boleh lebih kecil dari From Date ';
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }elseif($lockDate->tanggal_lock >= $to_date){
                $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }

            foreach ($schedules as $schedule) {
                    if ($lockDate->tanggal_lock >= $schedule->tanggal){
                        //kondisi sudah lock
                        $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                        return response()->json([
                            'success' => false,
                            'message' => $message,
                            'code'    => 400 ,
                            'icon'    => 'error' 
                        ]);
                    }else{
                        $isInsert = HRISRekapPresensi::where('nomor_user', $schedule->nomor_user)
                                                    ->where('tanggal', $schedule->tanggal)
                                                    ->count();
                       
                        if($isInsert == 1)
                        {//update
                            if($schedule->presensi_clock_in == null|| $schedule->presensi_clock_out == null){
                                if ($schedule->tipe_schedule == 'A'){
                                    $class_badge = 'A';
                                    $keterangan = 'Tidak Masuk Dan Tidak Ada Keterangan';
                                }elseif($schedule->tipe_schedule == 'L'){
                                    $class_badge = 'M';
                                    $keterangan = 'Jadwal Libur';
                                }else{

                                    $pengajuan = HRISPengajuan::where('nomor_user', $schedule->nomor_user)
                                                                ->whereDate('tanggal','<=',$schedule->tanggal)
                                                                ->whereDate('tanggal2','>=',$schedule->tanggal)
                                                                ->where('status_approve',1)
                                                                ->first();
                                    
                                    if ($pengajuan <> null){
                                        $class_badge = 'M';
                                        $keterangan = 'Approved By '.$pengajuan->approve_by.' pada '.$pengajuan->approve_at;
                                    }else{
                                        $class_badge = 'X';
                                        $keterangan = 'Belum Ada Keterangan';
                                    }

                                }

                                $total_jam_kerja = 0;
                                $hitung_hari_kerja = 0;
                            }else{
                                if ($schedule->tipe_schedule == 'M'){
                                    // Buat instance Carbon dari waktu 1 dan waktu 2 dengan tanggal yang sama
                                    $carbonWaktu1 = Carbon::createFromFormat('Y-m-d H:i:s', '2022-03-01 ' . $schedule->presensi_clock_in);
                                    $carbonWaktu2 = Carbon::createFromFormat('Y-m-d H:i:s', '2022-03-01 ' . $schedule->presensi_clock_out);
                                    // Hitung selisih waktu antara waktu 1 dan waktu 2 dalam detik
                                    $selisihDetik = $carbonWaktu1->diffInSeconds($carbonWaktu2);
                                    // Hitung selisih waktu dalam jam dalam format desimal
                                    $total_jam_kerja = $selisihDetik / 3600;

                                    $hari_kerja = HRISKodePresensi::where('kode_presensi',$schedule->tipe_schedule)->first();
                                    $hitung_hari_kerja = $hari_kerja->hitung_hari_kerja;

                                    if ($schedule->presensi_clock_in > '07:15:00' || $schedule->presensi_clock_out < '17:00:00'){ // parameter terlambat / pulang lebih cepat
                                        $pengajuan = HRISPengajuan::where('nomor_user', $schedule->nomor_user)
                                                                    ->whereDate('tanggal','<=',$schedule->tanggal)
                                                                    ->whereDate('tanggal2','>=',$schedule->tanggal)
                                                                    ->where('status_approve',1)
                                                                    ->first();
                                        if ($pengajuan <> null){
                                            $class_badge = 'M';
                                            $keterangan = 'Terlambat Atau Pulang Lebih Cepat Sudah Approved';
                                        }else{
                                            $class_badge = 'L';
                                            $keterangan = 'Terlambat Atau Pulang Lebih Cepat';
                                        }
                                    }else{
                                        $class_badge = 'M';
                                        $keterangan = 'Sesuai';
                                    }
                                }else{
                                    $pengajuan = HRISPengajuan::where('nomor_user', $schedule->nomor_user)
                                                                ->whereDate('tanggal','<=',$schedule->tanggal)
                                                                ->whereDate('tanggal2','>=',$schedule->tanggal)
                                                                ->where('status_approve',1)
                                                                ->first();
                                    
                                    if ($pengajuan <> null){
                                        $class_badge = 'M';
                                        $keterangan = 'Approved By '.$pengajuan->approve_by.' pada '.$pengajuan->approve_at;
                                    }else{
                                        $class_badge = 'X';
                                        $keterangan = 'Belum Ada Keterangan';
                                    }
                                }
                                    
                            }
                            
                            
    
                            $dataupdate = HRISRekapPresensi::where('nomor_user',$schedule->nomor_user)
                                                            ->where('tanggal', $schedule->tanggal)->update([
                                    'keterangan_status' => $keterangan,
                                    'clock_in' => $schedule->presensi_clock_in,
                                    'clock_out' => $schedule->presensi_clock_out,
                                    'koreksi_clock_in' => null,
                                    'koreksi_clock_out' => null,
                                    'total_jam_kerja' => $total_jam_kerja,
                                    'icon' => 'far fa-check-circle',
                                    'class_badge' => $class_badge,
                                    'hitung_hari_kerja' => $hitung_hari_kerja,
                                    'tipe_schedule' => $schedule->tipe_schedule,
                            ]);
                        }else{//insert
                            if($schedule->presensi_clock_in == null|| $schedule->presensi_clock_out == null){
                                if ($schedule->tipe_schedule == 'A'){
                                    $class_badge = 'A';
                                    $keterangan = 'Tidak Masuk Dan Tidak Ada Keterangan';
                                }elseif($schedule->tipe_schedule == 'L'){
                                    $class_badge = 'M';
                                    $keterangan = 'Jadwal Libur';
                                }else{
                                    $class_badge = 'X';
                                    $keterangan = 'Belum Ada Keterangan';
                                }

                                $total_jam_kerja = 0;
                                $hitung_hari_kerja = 0;
                                $keterangan = '';
                            }else{
                                if ($schedule->tipe_schedule == 'M'){
                                    // Buat instance Carbon dari waktu 1 dan waktu 2 dengan tanggal yang sama
                                    $carbonWaktu1 = Carbon::createFromFormat('Y-m-d H:i:s', '2022-03-01 ' . $schedule->presensi_clock_in);
                                    $carbonWaktu2 = Carbon::createFromFormat('Y-m-d H:i:s', '2022-03-01 ' . $schedule->presensi_clock_out);
                                    // Hitung selisih waktu antara waktu 1 dan waktu 2 dalam detik
                                    $selisihDetik = $carbonWaktu1->diffInSeconds($carbonWaktu2);
                                    // Hitung selisih waktu dalam jam dalam format desimal
                                    $total_jam_kerja = $selisihDetik / 3600;

                                    $hari_kerja = HRISKodePresensi::where('kode_presensi',$schedule->tipe_schedule)->first();
                                    $hitung_hari_kerja = $hari_kerja->hitung_hari_kerja;

                                    if ($schedule->presensi_clock_in > '07:15:00' || $schedule->presensi_clock_out < '17:00:00'){
                                        $class_badge = 'L';
                                        $keterangan = 'Terlambat Atau Pulang Lebih Cepat';
                                    }else{
                                        $class_badge = 'M';
                                        $keterangan = 'Sesuai';
                                    }
                                }else{
                                    $class_badge = 'X';
                                    $keterangan = 'Belum Ada Keterangan';
                                }
                            }
    
                            DB::table('hris_rekap_presensi')->insert([
                                'tipe_schedule' => $schedule->tipe_schedule,
                                'nomor_user' => $schedule->nomor_user,
                                'tanggal' => $schedule->tanggal,
                                'keterangan_status' => $keterangan,
                                'schedule_clock_in' => $schedule->clock_in,
                                'schedule_clock_out' => $schedule->clock_out,
                                'clock_in' => $schedule->presensi_clock_in,
                                'clock_out' => $schedule->presensi_clock_out,
                                'koreksi_clock_in' => null,
                                'koreksi_clock_out' => null,
                                'total_jam_kerja' => $total_jam_kerja,
                                'icon' => 'far fa-check-circle',
                                'class_badge' => $class_badge,
                                'hitung_hari_kerja' => $hitung_hari_kerja,
                            ]);
                            
                        }

                        //last insert id menu
                        // $scheduleID = $scheduleCreate->id;

                        //add log
                        // $islogactive = SystemParameter::first()->islogactive;
                        // if ($islogactive){
                        //     $this->addLog("hris_schedule", session()->get('username'), "", $nomor_user, "Create", "Create Schedule ".$nomor_user.' tanggal '.$tanggal);
                        // }
                    }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Rekap Presensi Berhasil Update!',
                'code'    => 200,
                'icon'    => 'success'  
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 400 ,
                'icon'    => 'error' 
            ]);
        }
    }
}

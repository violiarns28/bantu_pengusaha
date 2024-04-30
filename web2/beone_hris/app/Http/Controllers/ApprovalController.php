<?php

namespace App\Http\Controllers;

use App\Models\HRISGlobalLock;
use App\Models\HRISPengajuan;
use App\Models\HRISLembur;
use App\Models\SystemParameter;
use App\Models\Menu;
use App\Models\User;
use App\Models\SiteAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\loggingTrait;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        $route = '/approval';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));
        
        return view('hris.approval.approval');
    }

    public function getcountapproval(Request $request){
        // ##DATA PERMISSION
       $user_id = session()->get('id');
       $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

       $list_site_id = array();

       foreach($access_site as $as){
           array_push($list_site_id, $as->site_id);
       }

        $outstanding_approval = HRISPengajuan::join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
        ->where('hris_pengajuan.status_approve','=',0)
        ->whereIn('beone_users.site_id', $list_site_id)
        ->select('hris_pengajuan.*', 'beone_users.nama as nama')
        ->count();

        return $outstanding_approval;
    }

    public function getapprovaldata(Request $request){
       // ##DATA PERMISSION
       $user_id = session()->get('id');
       $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

       $list_site_id = array();

       foreach($access_site as $as){
           array_push($list_site_id, $as->site_id);
       }
       // ##END DATA PERMISSION
        $user_data = User::Where('id',$user_id)->first();

       ## Read value
       $draw = $request->get('draw');
       $start = $request->get("start");
       $rowperpage = $request->get("length"); // Rows display per page
   
       $columnIndex_arr = $request->get('order');
       $columnName_arr = $request->get('columns');
       $order_arr = $request->get('order');
       $search_arr = $request->get('search');
   
       $columnIndex = $columnIndex_arr[0]['column']; // Column index
       $columnName = $columnName_arr[$columnIndex]['data']; // Column name
       $columnSortOrder = $order_arr[0]['dir']; // asc or desc
       $searchValue = $search_arr['value']; // Search value

       $tanggal = $request->get('tanggal');

        // Total records
        $totalRecords1 = HRISPengajuan::select('count(*) as allcount')
                        ->join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
                        ->where('hris_pengajuan.status_approve','=',0)
                        ->whereIn('beone_users.site_id', $list_site_id)
                        ->count();
        $totalRecordswithFilter1 = HRISPengajuan::select('count(*) as allcount')
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
        ->where(function($query) use ($request)
            {
                if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                    $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                }
            })
        ->where('hris_pengajuan.status_approve','=',0)
        ->whereIn('beone_users.site_id', $list_site_id)
        ->select('hris_pengajuan.*', 'beone_users.nama as nama')
        ->count();



        $totalRecords2 = HRISLembur::select('count(*) as allcount')
                        ->join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
                        ->where('hris_lembur.status_approve','=',0)
                        ->whereIn('beone_users.site_id', $list_site_id)
                        ->count();

        $totalRecordswithFilter2 = HRISLembur::select('count(*) as allcount')
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
        ->where(function($query) use ($request)
            {
                if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                    $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                }
            })
        ->where('hris_lembur.status_approve','=',0)
        ->whereIn('beone_users.site_id', $list_site_id)
        ->select('hris_lembur.*', 'beone_users.nama as nama')
        ->count();

        $totalRecords = $totalRecords1 + $totalRecords2;
        $totalRecordswithFilter = $totalRecordswithFilter1 + $totalRecordswithFilter2;


        // Fetch records
        $firstQuery = HRISPengajuan::orderBy('tanggal',$columnSortOrder)
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_pengajuan.nomor_user')
        ->where(function($query) use ($request)
                {
                    if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                        $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                    }
                })
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

        $secondQuery = HRISLembur::orderBy('tanggal',$columnSortOrder)
        ->join('beone_users', 'beone_users.nomor', '=', 'hris_lembur.nomor_user')
        ->where(function($query) use ($request)
                {
                    if ($request->has('tanggal')  &&  $request->input('tanggal') != '') {
                        $query->where('tanggal','like', '%'.  $request->input('tanggal').'%');
                    }
                })
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

        $records = $firstQuery->union($secondQuery)->get();

    $data = [
        'data' => $records,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecordswithFilter,
    ];
    return response()->json($data, 200);
    }


    public function approve($id, $jenis_pengajuan)
    {
        DB::beginTransaction();

        try {
            $route = '/approval';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('update', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();

            if ($jenis_pengajuan == 'LEMBUR'){
                $dateAction = HRISLembur::where('id', $id)->value('tanggal');
            }else{
                $dateAction = HRISPengajuan::where('id', $id)->value('tanggal');
            }

            if ($lockDate->tanggal_lock >= $dateAction){
                //kondisi sudah lock
                $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }else{

                if ($jenis_pengajuan == 'LEMBUR'){
                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_lembur", session()->get('username'), $id, "", "Update", "Approve Lembur tanggal ".$dateAction);
                    }
                    
                    $dataupdate = HRISLembur::where('id',$id)->update([
                        'status_approve' => 1,
                        'approve_at' => Carbon::now(),
                        'approve_by' => session()->get('username'),
                    ]);
                }else{
                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_pengajuan", session()->get('username'), $id, "", "Update", "Approve Pengajuan tanggal ".$dateAction);
                    }
                    
                    $dataupdate = HRISPengajuan::where('id',$id)->update([
                        'status_approve' => 1,
                        'approve_at' => Carbon::now(),
                        'approve_by' => session()->get('username'),
                    ]);
                }
                
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Pengajuan Berhasil Approve!',
                    'code'    => 200,
                    'icon'    => 'success'  
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 400 ,
                'icon'    => 'error' 
            ]);
        }
    }

    public function reject($id, $jenis_pengajuan)
    {
        DB::beginTransaction();

        try {
            $route = '/approval';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('update', Menu::find($menu_id));

            $lockDate = HRISGlobalLock::orderBy('tanggal_lock','desc')->first();
            
            if ($jenis_pengajuan == 'LEMBUR'){
                $dateAction = HRISLembur::where('id', $id)->value('tanggal');
            }else{
                $dateAction = HRISPengajuan::where('id', $id)->value('tanggal');
            }

            if ($lockDate->tanggal_lock >= $dateAction){
                //kondisi sudah lock
                $message = 'Sudah Ada Periode Closing '.$lockDate->tanggal_lock;
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code'    => 400 ,
                    'icon'    => 'error' 
                ]);
            }else{
                if ($jenis_pengajuan == 'LEMBUR'){
                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_lembur", session()->get('username'), $id, "", "Update", "Reject Lembur tanggal ".$dateAction);
                    }
                    
                    $dataupdate = HRISLembur::where('id',$id)->update([
                        'status_approve' => 2,
                        'approve_at' => Carbon::now(),
                        'approve_by' => session()->get('username'),
                    ]);
                }else{
                    //add log
                    $islogactive = SystemParameter::first()->islogactive;
                    if ($islogactive){
                        $this->addLog("hris_pengajuan", session()->get('username'), $id, "", "Update", "Reject Pengajuan tanggal ".$dateAction);
                    }
                    
                    $dataupdate = HRISPengajuan::where('id',$id)->update([
                        'status_approve' => 2,
                        'approve_at' => Carbon::now(),
                        'approve_by' => session()->get('username'),
                    ]);
                }
                
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Pengajuan Berhasil Reject!',
                    'code'    => 200,
                    'icon'    => 'success'  
                ]);
            }
        } catch (\Exception $e) {
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

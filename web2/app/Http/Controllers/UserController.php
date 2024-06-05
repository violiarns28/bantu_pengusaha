<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Group;
use App\Models\SystemParameter;
use App\Models\SiteAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\loggingTrait;

class UserController extends Controller
{
    use loggingTrait;

    public function index(Request $request)
    {
        $route = '/masterUser';
        $menu_id = Menu::where('route_menu', $route)->first()->id;
        $this->authorize('view', Menu::find($menu_id));

        $listGroup = Group::all();

        return view('master.user')
        ->with(compact('listGroup'));
    }

    public function getuserdata(Request $request){
        // ##DATA PERMISSION
        $user_id = session()->get('id');
        $access_site = SiteAccess::Where('user_id',$user_id)->select('site_id')->get();

        $list_site_id = array();

        foreach($access_site as $as){
            array_push($list_site_id, $as->site_id);
        }
        // ##END DATA PERMISSION

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

        $nama = $request->get('nama');

        // Total records
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')
        ->join('beone_group', 'beone_group.id', '=', 'beone_users.group_id')
        ->where(function($query) use ($request)
            {
                if ($request->has('nama')  &&  $request->input('nama') != '') {
                    $query->where('beone_users.nama','like', '%'.  $request->input('nama').'%');
                }
            })
        ->whereIn('beone_users.site_id',$list_site_id)
        ->select('beone_users.*', 'beone_group.nama as nama_group')
        ->count();


        // Fetch records
        $records = User::orderBy('beone_users.nama',$columnSortOrder)
        ->join('beone_group', 'beone_group.id', '=', 'beone_users.group_id')
        ->where(function($query) use ($request)
               {
                   if ($request->has('nama')  &&  $request->input('nama') != '') {
                       $query->where('beone_users.nama','like', '%'.  $request->input('nama').'%');
                   }
               })
          ->whereIn('beone_users.site_id',$list_site_id)
          ->select('beone_users.*', 'beone_group.nama as nama_group')
          ->skip($start)
          ->take($rowperpage)
          ->get();

        //   $records = User::all();
        //   $totalRecords = 1;
        //   $totalRecordswithFilter = 1;

       $data = [
           'data' => $records,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecordswithFilter,
       ];
       return response()->json($data, 200);
       }


       public function insertuserdata(Request $request){
            DB::beginTransaction();
            try {
                $route = '/masterUser';
                $menu_id = Menu::where('route_menu', $route)->first()->id;
                $this->authorize('create', Menu::find($menu_id));

                $input = $request->all();

                $input['password'] = Hash::make($input['newpassword']);
                $input['username'] = $input['username'];
                $input['nomor'] = $input['nomor'];
                $input['nama'] = $input['nama'];
                $input['email'] = $input['email'];
                $input['group_id'] = $input['group_id'];

                $userCreate = User::create($input);

                //last insert id menu
                $userID = $userCreate->id;

                //add log
                $islogactive = SystemParameter::first()->islogactive;
                if ($islogactive){
                    $this->addLog("beone_users", session()->get('username'), $userID, "", "Create", "Created User ".$input['nama']);
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Data User '.$input['username'].' Berhasil Ditambahkan!',
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

    public function updateuserdata(Request $request)
    {
        DB::beginTransaction();

        try {
            $route = '/masterUser';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('update', Menu::find($menu_id));

            $user = User::where('id', $request->input('editID'))->first();
            $rules = [
                'editUsername' => 'required',
                'editNama' => 'required',
                'editNomor' => 'required',
                'editGroupID' => 'required',
                'editEmail' => 'required'
            ];
            $this->validate($request,$rules);

            $dataupdate = User::where('id',$request->input('editID'))->update([
                'username' => $request->input('editUsername'),
                'nama' => $request->input('editNama'),
                'nomor' => $request->input('editNomor'),
                'email' => $request->input('editEmail'),
                'group_id' => $request->input('editGroupID'),
            ]);

            //add log
            $islogactive = SystemParameter::first()->islogactive;
            if ($islogactive){
                $this->addLog("beone_users", session()->get('username'), $request->input('editID'), "", "Update", "Update User ".$request->input('editNama'));
            }

            DB::commit();
            toast('You\'ve Successfully Update','success'); //using toast
            // return redirect('/masterUser')->with('Success','update user '.$request->input('editUsername'));
            // return response()->json(true, 200);
            return response()->json([
                'success' => true,
                'message' => 'Data User '.$request->input('editUsername').' Berhasil Update!',
                'code'    => 200,
                'icon'    => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // return redirect('/masterUser')->with('Error',$e->getMessage());
            // return response()->json(false, 200);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 400 ,
                'icon'    => 'error'
            ]);
        }
    }


    public function getoneuserdata($id)
    {
        $data = User::where('id', $id)->get();
        return response()->json($data);
    }
 

    public function deleteusernew($id)
    {
        DB::beginTransaction();

        try {
            $route = '/masterUser';
            $menu_id = Menu::where('route_menu', $route)->first()->id;
            $this->authorize('delete', Menu::find($menu_id));

            $nama_user = User::where('id', $id)->value('nama');

            //add log
            $islogactive = SystemParameter::first()->islogactive;
            if ($islogactive){
                $this->addLog("beone_users", session()->get('username'), $id, "", "Delete", "Delete User ".$nama_user);
            }

            $delete_data = User::where('id', $id)->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data User '.$nama_user.' Berhasil Dihapus!',
                'code'    => 200,
                'icon'    => 'success'
            ]);

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

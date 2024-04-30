<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    // use loggingTrait;

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request){

    try{
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        return response()->json([
            'success' => true,
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            $user = User::where('username','=',$request->input('username'))->first();
            // $menu = Menu::all();
            // $parent_menu = Menu::Where('isparent','=',1)->get();
            // $sub_menu = Menu::Where('issubparent','=',1)->get();


            $parent_menu = DB::table('beone_group_access')
                        ->join('beone_menu', 'beone_group_access.menu_id', '=', 'beone_menu.id')
                        ->where('beone_group_access.group_id', $user->group_id)
                        ->where('beone_menu.isparent', 1)
                        ->where('beone_group_access.access_id', 1)
                        ->get();

            $sub_menu = DB::table('beone_group_access')
                        ->join('beone_menu', 'beone_group_access.menu_id', '=', 'beone_menu.id')
                        ->where('beone_group_access.group_id', $user->group_id)
                        ->where('beone_menu.issubparent', 1)
                        ->where('beone_group_access.access_id', 1)
                        ->get();

            $menu = DB::table('beone_group_access')
                        ->join('beone_menu', 'beone_group_access.menu_id', '=', 'beone_menu.id')
                        ->where('beone_group_access.group_id', $user->group_id)
                        ->where('beone_menu.isparent', 0)
                        ->where('beone_menu.issubparent', 0)
                        ->where('beone_group_access.access_id', 1)
                        ->get();

            // $menu = $user->canViewMenus();
            // Via a request instance...
            $request->session()->put('id', $user->id);
            $request->session()->put('group_id', $user->group_id);
            $request->session()->put('username', $user->username);
            $request->session()->put('nama', $user->nama);
            $request->session()->put('email', $user->email);
            $request->session()->put('listmenu', $menu);
            $request->session()->put('listparentmenu', $parent_menu);
            $request->session()->put('listsubmenu', $sub_menu);
                
            // $request->session()->put('usergroup', $user->usergroup);
            // $request->session()->put('statusaktif', $user->statusaktif);

            //memberikan akses menu
            // $request->session()->put('listmenu', $menu);

            toast('Welcome back '.$user->username,'success');
            // return redirect()->intended('dashboard');
            return response()->json([
                'success' => true,
                'message' => 'Login Successfully!, Welcome '.$user->username,
                'code'    => 200,
                'icon'    => 'success'  
            ]);
        }
        // toast('Failed Login ','success');
        // return back()->with('loginError','Username Password Or Connection ...!');

        return response()->json([
            'success' => true,
            'message' => 'Login Failed!, Check Username Password Or Connection ...!',
            'code'    => 400,
            'icon'    => 'error'  
        ]);
    }catch(\Exception $e){
        // toast('Failed Login','success');
        // return back()->with('loginError','Username Password Or Connection ...!');
        return response()->json([
            'success' => true,
            'message' => 'Login Failed!, Check Username Password Or Connection ...!',
            'code'    => 400,
            'icon'    => 'error'  
        ]);
    }
    }

    public function dologout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/login');
    }
    
}

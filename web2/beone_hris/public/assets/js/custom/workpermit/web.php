<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ApdController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfController;
use App\Http\Controllers\DtlAreaController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\Stop6Controller;
use App\Http\Controllers\SpesifikController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkpermitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index']);//->middleware('guest')->middleware('auth');
Route::get('/login', [LoginController::class, 'index'])->name('login');;//->middleware('guest')->middleware('auth');
Route::post('/dologin', [LoginController::class, 'authenticate']);
Route::get('/dologout', [LoginController::class, 'dologout'])->middleware('auth');
Route::get('/loginotp', [LoginController::class, 'authotp'])->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

Route::get('/masterUser', [UserController::class, 'index'])->middleware('auth');
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');
Route::get('/getuser', [UserController::class, 'getuserdata'])->middleware('auth');
Route::get('/getoneuser', [UserController::class, 'getoneuser'])->middleware('auth');
Route::post('/insertuser', [UserController::class, 'insertuserdata'])->middleware('auth');
Route::post('/deleteuser', [UserController::class, 'deleteuser'])->middleware('auth');
Route::post('/deleteuserMulti', [UserController::class, 'deleteuserMulti'])->middleware('auth');

Route::get('/masterSection', [SectionController::class, 'index'])->middleware('auth');
Route::get('/getsection', [SectionController::class, 'getsectiondata'])->middleware('auth');
Route::get('/getonesection', [SectionController::class, 'getonesection'])->middleware('auth');
Route::post('/insertsection', [SectionController::class, 'insertsectiondata'])->middleware('auth');
Route::post('/deletesection', [SectionController::class, 'deletesection'])->middleware('auth');
Route::post('/deleteSectionMulti', [SectionController::class, 'deleteMulti'])->middleware('auth');


Route::get('/masterGroup', [GroupController::class, 'index'])->middleware('auth');
Route::get('/getgroup', [GroupController::class, 'getgroupdata'])->middleware('auth');
Route::get('/getonegroup', [GroupController::class, 'getonegroup'])->middleware('auth');
Route::post('/insertgroup', [GroupController::class, 'insertgroupdata'])->middleware('auth');
Route::post('/deletegroup', [GroupController::class, 'deletegroup'])->middleware('auth');
Route::post('/deletemultigroup', [GroupController::class, 'deletemultigroup'])->middleware('auth');


Route::get('/masterPekerjaan', [PekerjaanController::class, 'index'])->middleware('auth');
Route::get('/getpekerjaan', [PekerjaanController::class, 'getpekerjaandata'])->middleware('auth');
Route::get('/getonejob', [PekerjaanController::class, 'getonejob'])->middleware('auth');
Route::post('/insertjob', [PekerjaanController::class, 'insertjobdata'])->middleware('auth');
Route::post('/deletejob', [PekerjaanController::class, 'deletejob'])->middleware('auth');


Route::get('/masterCompany', [VendorController::class, 'index'])->middleware('auth');
Route::get('/getvendor', [VendorController::class, 'getvendordata'])->middleware('auth');
Route::get('/getonevendor', [VendorController::class, 'getonevendor'])->middleware('auth');
Route::post('/insertvendor', [VendorController::class, 'insertvendordata'])->middleware('auth');
Route::post('/deletevendor', [VendorController::class, 'deletevendor'])->middleware('auth');
Route::post('/deleteMultivendor', [VendorController::class, 'deletemulti'])->middleware('auth');

Route::get('/masterPosition', [PositionController::class, 'index'])->middleware('auth');
Route::get('/getPos', [PositionController::class, 'getvendordata'])->middleware('auth');
Route::get('/getonePos', [PositionController::class, 'getonevendor'])->middleware('auth');
Route::post('/insertPos', [PositionController::class, 'insertvendordata'])->middleware('auth');
Route::post('/deletePos', [PositionController::class, 'deletevendor'])->middleware('auth');
Route::post('/deleteMultiPos', [PositionController::class, 'deletemulti'])->middleware('auth');

Route::get('/masterPIC', [PicController::class, 'index'])->middleware('auth');
Route::get('/getPic', [PicController::class, 'getvendordata'])->middleware('auth');
Route::get('/getonePIC', [PicController::class, 'getonevendor'])->middleware('auth');
Route::post('/insertPIC', [PicController::class, 'insertvendordata'])->middleware('auth');
Route::post('/deletePIC', [PicController::class, 'deletevendor'])->middleware('auth');
Route::post('/deleteMultiPIC', [PicController::class, 'deletemulti'])->middleware('auth');

Route::get('/masterApd', [ApdController::class, 'index'])->middleware('auth');
Route::get('/getapd', [ApdController::class, 'getapddata'])->middleware('auth');
Route::get('/getapds', [ApdController::class, 'getapd'])->middleware('auth');
Route::get('/getoneapd', [ApdController::class, 'getoneapd'])->middleware('auth');
Route::post('/insertapd', [ApdController::class, 'insertapddata'])->middleware('auth');
Route::post('/deleteapd', [ApdController::class, 'deleteapd'])->middleware('auth');
Route::post('/deleteapdMulti', [ApdController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterTools', [ToolsController::class, 'index'])->middleware('auth');
Route::get('/gettools', [ToolsController::class, 'gettooldata'])->middleware('auth');
Route::get('/gettoolss', [ToolsController::class, 'gettoolss'])->middleware('auth');
Route::get('/getonetool', [ToolsController::class, 'getonetool'])->middleware('auth');
Route::post('/inserttool', [ToolsController::class, 'inserttooldata'])->middleware('auth');
Route::post('/deletetool', [ToolsController::class, 'deletetool'])->middleware('auth');
Route::post('/deleteToolMulti', [ToolsController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterUtility', [UtilityController::class, 'index'])->middleware('auth');
Route::get('/getUtility', [UtilityController::class, 'getdata'])->middleware('auth');
Route::get('/getUtils', [UtilityController::class, 'getutils'])->middleware('auth');
Route::get('/getoneutility', [UtilityController::class, 'getone'])->middleware('auth');
Route::post('/insertutility', [UtilityController::class, 'insertdata'])->middleware('auth');
Route::post('/deleteutility', [UtilityController::class, 'delete'])->middleware('auth');
Route::post('/deleteUtilityMulti', [UtilityController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterpengumuman', [PengumumanController::class, 'index'])->middleware('auth');
Route::get('/getpengumuman', [PengumumanController::class, 'getdata'])->middleware('auth');
Route::get('/getonepengumuman', [PengumumanController::class, 'getonepengumuman'])->middleware('auth');
Route::post('/insertpengumuman', [PengumumanController::class, 'insertdata'])->middleware('auth');
Route::post('/deletepengumuman', [PengumumanController::class, 'delete'])->middleware('auth');
Route::post('/deleteAnnounceMulti', [PengumumanController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterCategory', [CategoryController::class, 'index'])->middleware('auth');
Route::get('/getCategory', [CategoryController::class, 'getdata'])->middleware('auth');
Route::get('/getcats', [CategoryController::class, 'getcats'])->middleware('auth');
Route::get('/getonecategory', [CategoryController::class, 'getone'])->middleware('auth');
Route::post('/insertcategory', [CategoryController::class, 'insertdata'])->middleware('auth');
Route::post('/deleteCat', [CategoryController::class, 'delete'])->middleware('auth');
Route::post('/deleteMultiCat', [CategoryController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterStop6', [Stop6Controller::class, 'index'])->middleware('auth');
Route::get('/getstop', [Stop6Controller::class, 'getdata'])->middleware('auth');
Route::get('/getstop6', [Stop6Controller::class, 'getstop6'])->middleware('auth');
Route::get('/getonestop', [Stop6Controller::class, 'getone'])->middleware('auth');
Route::post('/insertstop', [Stop6Controller::class, 'insertdata'])->middleware('auth');
Route::post('/deletestop', [Stop6Controller::class, 'delete'])->middleware('auth');
Route::post('/deleteMultiStop', [Stop6Controller::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterRank', [Stop6Controller::class, 'indexRank'])->middleware('auth');
Route::get('/getrank', [Stop6Controller::class, 'getdatarank'])->middleware('auth');
Route::get('/getonerank', [Stop6Controller::class, 'getonerank'])->middleware('auth');
Route::get('/getranks', [Stop6Controller::class, 'getrank'])->middleware('auth');
Route::post('/insertrank', [Stop6Controller::class, 'insertdatarank'])->middleware('auth');
Route::post('/deleterank', [SkillController::class, 'deleterank'])->middleware('auth');
Route::post('/deleteMultiRank', [SkillController::class, 'deleteMultiRank'])->middleware('auth');

Route::get('/masterSkill', [SkillController::class, 'index'])->middleware('auth');
Route::get('/getskill', [SkillController::class, 'getdata'])->middleware('auth');
Route::get('/getskills', [SkillController::class, 'getskill'])->middleware('auth');
Route::get('/getoneskill', [SkillController::class, 'getone'])->middleware('auth');
Route::post('/insertskill', [SkillController::class, 'insert'])->middleware('auth');
Route::post('/deleteskill', [SkillController::class, 'delete'])->middleware('auth');
Route::post('/deleteMultiSkill', [SkillController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterArea', [AreaController::class, 'index'])->middleware('auth');
Route::get('/getarea', [AreaController::class, 'getdata'])->middleware('auth');
Route::get('/getonearea', [AreaController::class, 'getone'])->middleware('auth');
Route::post('/insertarea', [AreaController::class, 'insertdata'])->middleware('auth');
Route::post('/deletearea', [AreaController::class, 'delete'])->middleware('auth');
Route::post('/deleteMultiArea', [AreaController::class, 'deleteMulti'])->middleware('auth');


Route::get('/masterSpesifik', [SpesifikController::class, 'index'])->middleware('auth');
Route::get('/getspesifik', [SpesifikController::class, 'getdata'])->middleware('auth');
Route::get('/getonespesifik', [SpesifikController::class, 'getone'])->middleware('auth');
Route::post('/getbyarea', [SpesifikController::class, 'getbyArea'])->middleware('auth');
Route::post('/insertspesifik', [SpesifikController::class, 'insertdata'])->middleware('auth');
Route::post('/deletespesifik', [SpesifikController::class, 'delete'])->middleware('auth');
Route::post('/deleteMultispesifik', [SpesifikController::class, 'deleteMulti'])->middleware('auth');


Route::get('/masterDtlArea', [DtlAreaController::class, 'index'])->middleware('auth');
Route::get('/getdetilarea', [DtlAreaController::class, 'getdata'])->middleware('auth');
Route::get('/getonedetilarea', [DtlAreaController::class, 'getone'])->middleware('auth');
Route::post('/insertdetilarea', [DtlAreaController::class, 'insertdata'])->middleware('auth');
Route::post('/deletedetilarea', [DtlAreaController::class, 'delete'])->middleware('auth');
Route::post('/deleteMultidetilarea', [DtlAreaController::class, 'deleteMulti'])->middleware('auth');

Route::get('/masterconf', [ConfController::class, 'index'])->middleware('auth');
Route::post('/insertconf', [ConfController::class, 'insert'])->middleware('auth');

Route::get('/workpermit', [WorkpermitController::class, 'index'])->middleware('auth');
Route::get('/getwp', [WorkpermitController::class, 'getdata'])->middleware('auth');
Route::get('/addworkpermit', [WorkpermitController::class, 'addwp'])->middleware('auth');
Route::post('/getonewp', [WorkpermitController::class, 'getonedata'])->middleware('auth');
Route::post('/gettglwp', [WorkpermitController::class, 'gettglwp'])->middleware('auth');
Route::post('/getspesifikwp', [WorkpermitController::class, 'getspesifikwp'])->middleware('auth');
Route::post('/insertwp', [WorkpermitController::class, 'savewp'])->middleware('auth');
Route::post('/insertdw', [WorkpermitController::class, 'savedw'])->middleware('auth');

Route::get('/404', function () {
    return view('404');
})->middleware('auth');

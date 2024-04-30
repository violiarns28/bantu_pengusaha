<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuAccessController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupAccessController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SiteAccessController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\KodePresensiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\LemburController;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::view('/swal', 'swal');
Route::view('/swal-form', 'swal-form');
Route::view('/swal-icon', 'swal-icon');
Route::view('/swal-display', 'swal-display');

Route::get('/', [LoginController::class, 'index']);
Route::post('/dologin', [LoginController::class, 'authenticate']);
Route::get('/login', [LoginController::class, 'index'])->name('login');



Route::middleware('isLoggedin')->group(function () {
    Route::get('/dashboard', function() {return view('layouts.dashboard');})->name('dashboard');

    Route::get('/masterUser', [UserController::class, 'index'])->name('user.list');
    Route::get('/getuser', [UserController::class, 'getuserdata'])->name('user.data');
    Route::post('/insertuser', [UserController::class, 'insertuserdata'])->name('user.insert');
    Route::post('/updateuser', [UserController::class, 'updateuserdata'])->name('user.update');
    Route::get('/deleteuser/{id}', [UserController::class, 'deleteuser']);
    Route::get('/deleteusernew/{id}', [UserController::class, 'deleteusernew']);
    Route::get('/getoneuser/{id}', [UserController::class, 'getoneuserdata']);

    Route::get('/masterMenu', [MenuController::class, 'index']);
    Route::get('/getMenu', [MenuController::class, 'getmenudata'])->name('menu.data');
    Route::post('/insertmenu', [MenuController::class, 'insertmenudata'])->name('menu.insert');
    Route::get('/getonemenu/{id}', [MenuController::class, 'getonemenudata']);
    Route::post('/updatemenu', [MenuController::class, 'updatemenudata'])->name('menu.update');
    Route::get('/deletemenu/{id}', [MenuController::class, 'deletemenu']);

    Route::get('/masterMenuAccess', [MenuAccessController::class, 'index']);
    Route::post('/updatemenuaccess', [MenuAccessController::class, 'updatemenuaccessdata'])->name('menuaccess.update');

    Route::get('/masterGroup', [GroupController::class, 'index'])->name('group.index');
    Route::get('/getgroup', [GroupController::class, 'getgroupdata'])->name('group.data');
    Route::post('/insertgroup', [GroupController::class, 'insertgroupdata'])->name('group.insert');
    Route::get('/getonegroup/{id}', [GroupController::class, 'getonegroupdata']);
    Route::post('/updategroup', [GroupController::class, 'updategroupdata'])->name('group.update');
    Route::get('/deletegroup/{id}', [GroupController::class, 'deletegroup']);

    Route::get('/getonegroupaccess/{GroupID}', [GroupAccessController::class, 'getonegroupaccess']);
    Route::post('/updategroupaccess', [GroupAccessController::class, 'updategroupaccessdata'])->name('groupaccess.update');
    
    Route::get('/masterSchedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/summarySchedule', [ScheduleController::class, 'indexSummarySchedule'])->name('summary_schedule.index');
    Route::get('/getschedule', [ScheduleController::class, 'getscheduledata'])->name('schedule.data');
    Route::post('/insertschedule', [ScheduleController::class, 'insertscheduledata'])->name('schedule.insert');
    Route::get('/getoneschedule/{id}', [ScheduleController::class, 'getonescheduledata']);
    Route::post('/updateschedule', [ScheduleController::class, 'updatescheduledata'])->name('schedule.update');
    Route::get('/deleteschedule/{id}', [ScheduleController::class, 'deleteschedule'])->name('schedule.delete');
    Route::get('/deletebatchschedule/{id}', [ScheduleController::class, 'deletebatchschedule'])->name('schedule.deletebatch');
    Route::post('/deleteschedulesummary', [ScheduleController::class, 'deleteschedulesummary'])->name('schedulesummary.delete');

    Route::get('/masterSite', [SiteController::class, 'index'])->name('site.index');
    Route::get('/getsite', [SiteController::class, 'getsitedata'])->name('site.data');
    Route::post('/insertsite', [SiteController::class, 'insertsitedata'])->name('site.insert');

    Route::get('/siteAccess', [SiteAccessController::class, 'index'])->name('siteaccess.index');
    Route::get('/getsiteaccess', [SiteAccessController::class, 'getsiteaccessdata'])->name('siteaccess.data');
    Route::get('/getonesiteaccess/{id}', [SiteAccessController::class, 'getonesiteaccessdata']);
    Route::post('/updatesiteaccess', [SiteAccessController::class, 'updatesiteaccessdata'])->name('siteaccess.update');

    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::get('/getpresensi', [PresensiController::class, 'getpresensidata'])->name('presensi.data');
    Route::post('/insertpresensi', [PresensiController::class, 'insertpresensidata'])->name('presensi.insert');

    Route::get('/rekappresensi', [RekapPresensiController::class, 'index'])->name('rekap.index');
    Route::post('/calcRekapPresensi', [RekapPresensiController::class, 'calcrekap'])->name('rekap.calc');
    Route::get('/getonerekap/{id}', [RekapPresensiController::class, 'getonerekapdata']);
    
    Route::get('/getonekodepresensi/{kode}', [KodePresensiController::class, 'getonekodepresensidata']);

    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/getpengajuan', [PengajuanController::class, 'getpengajuandata'])->name('pengajuan.data');
    Route::post('/insertpengajuan', [PengajuanController::class, 'insertpengajuandata'])->name('pengajuan.insert');
    Route::get('/getonepengajuan/{id}', [PengajuanController::class, 'getonepengajuandata']);
    Route::post('/updatepengajuan', [PengajuanController::class, 'updatepengajuandata'])->name('pengajuan.update');
    Route::get('/deletepengajuan/{id}', [PengajuanController::class, 'deletepengajuan'])->name('pengajuan.delete');

    Route::get('/approval', [ApprovalController::class, 'index'])->name('approval.index');
    Route::get('/getapproval', [ApprovalController::class, 'getapprovaldata'])->name('approval.data');
    Route::get('/getoutstandingapproval', [ApprovalController::class, 'getcountapproval'])->name('approval.count');
    Route::get('/approve/{id}/{jenis_pengajuan}', [ApprovalController::class, 'approve'])->name('approval.approve');
    Route::get('/reject/{id}/{jenis_pengajuan}', [ApprovalController::class, 'reject'])->name('approval.reject');

    Route::get('/lembur', [LemburController::class, 'index'])->name('lembur.index');
    Route::get('/getlembur', [LemburController::class, 'getlemburdata'])->name('lembur.data');
    Route::post('/insertlembur', [LemburController::class, 'insertlemburdata'])->name('lembur.insert');
    Route::get('/getonelembur/{id}', [LemburController::class, 'getonelemburdata']);
    Route::post('/updatelembur', [LemburController::class, 'updatelemburdata'])->name('lembur.update');
    Route::get('/deletelembur/{id}', [LemburController::class, 'deletelembur'])->name('lembur.delete');

    Route::get('/test', [RekapPresensiController::class, 'test']);


    // Route::post('/dologout', [LoginController::class, 'dologout']);
    Route::get('/dologout', [LoginController::class, 'dologout']);
});
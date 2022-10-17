<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PakageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RequestStatusController;
use App\Http\Controllers\SimNetworkController;
use App\Http\Controllers\UserManagermentController;
use App\Models\Invoice;
use App\Models\RequestStatus;

Route::group(['middleware'=>['auth','role:admin']],function(){
    // Route::get('/',function(){
    //     return view('admin.pages.dashboard');
    // })->name('admin');
    Route::get('/',[DashBoardController::class,'index'])->name('admin');

    Route::get('nguoi-dung',[UserManagermentController::class,'index']);
    Route::post('sua-nguoi-dung',[UserManagermentController::class,'update']);
    Route::post('them-nguoi-dung',[UserManagermentController::class,'store']);
    Route::get('danh-sach-sim-yeu-cau',[RequestController::class,'showRequestSim']);
    Route::get('danh-sach-sim',[SimCardController::class,'index']);
    Route::post('add-sim',[SimCardController::class,'store']);
    Route::post('import-sim',[SimCardController::class,'import']);
    Route::post('phan-phoi-sim',[SimCardController::class,'distribution']);
    Route::post('update-sim',[SimCardController::class,'update']);
    Route::post('update-status-sim',[SimCardController::class,'updateStatus']);
    Route::post('rent-sim', [SimCardController::class,'rentSim']);
    Route::get('get-bill-info/{id}',[SimCardController::class,'getBill']);
    Route::get('goi-cuoc',[PakageController::class,'index']);
    Route::post('them-goi-cuoc',[PakageController::class,'store']);
    Route::post('reply-request',[RequestController::class,'replyRequest']);
    Route::post('rent-sim-new-customer',[SimCardController::class,'rentSimNewCustomer']);
    Route::get('doanh-thu',[InvoiceController::class,'index']);
    Route::post('them-dai-ly',[PartnerController::class,'store']);
    Route::post('cap-nhat-thong-tin-dai-ly',[PartnerController::class,'update']);
    Route::post('xoa-dai-ly',[PartnerController::class,'delete']);
    Route::post('xoa-nguoi-dung',[UserManagermentController::class,'delete']);

    Route::get('nha-mang',[RequestController::class,'showNetwork']);
    Route::get('goi-cuoc-wifi',[RequestController::class,'showPackage']);
    Route::post('add-wifi-network',[RequestController::class,'createNetwork']);
    Route::post('add-wifi-package',[RequestController::class,'createPackage']);
    Route::get('cong-tac-vien',[PartnerController::class,'index']);
    Route::get('cong-tac-vien/{id}',[PartnerController::class,'showProduct']);
    Route::post('cong-tac-vien/danh-sach-sim',[PartnerController::class,'showListSim']);
    Route::post('them-chu-so-huu',[PartnerController::class,'addOwner']);
    Route::get('nha-mang-sim',[SimNetworkController::class,'index']);
    Route::post('them-nha-mang-sim',[SimNetworkController::class,'store']);
    Route::post('gia-han-hop-dong',[SimCardController::class,'extendContract']);


    Route::get('export-hom-nay', [ExportController::class,'exportToday']);
    Route::get('export-tuan-nay', [ExportController::class,'exportWeek']);
    Route::get('export-thang-nay', [ExportController::class,'exportMonth']);
    Route::post('export-tuy-chon',[ExportController::class,'exportCustom']);
    Route::get('thay-doi-trang-thai-sim/{status}',[SimCardController::class,'changeStatus']);
    Route::get('xac-nhan-yeu-cau/{id}',[RequestStatusController::class,'changeStatus']);
    Route::get('xoa-yeu-cau/{id}',[RequestStatusController::class,'delete']);
    Route::get('xoa-sim/{id}',[SimCardController::class,'delete']);
    Route::get('get-sim-network/{id}',[SimNetworkController::class,'edit']);
    Route::get('delete-sim-network/{id}',[SimNetworkController::class,'delete']);
    Route::post('update-sim-network',[SimNetworkController::class,'update']);
    Route::post('sua-nha-mang-wifi',[RequestController::class,'update']);
    Route::post('delete-wifi-network',[RequestController::class,'delete']);

    Route::get('get-wifi-package/{id}',[RequestController::class,'editPackage']);
    Route::post('update-wifi-package',[RequestController::class,'updateWifiPackage']);
    Route::post('delete-wifi-network',[RequestController::class,'deletePackage']);
});




Route::get('{any}',function(){
    return view('admin.layout.app');
});


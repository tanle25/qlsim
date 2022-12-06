<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PakageController;
use App\Http\Controllers\Partner\ExportControlller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\Partner\SimCardController as Dealer;
use App\Http\Controllers\RequestStatusController;

Route::group(['middleware'=>['auth','role:dealer|collab']], function(){
    Route::get('/',[DashBoardController::class,'userIndex'])->name('dealer');
    Route::post('request-status-sim',[RequestStatusController::class,'sendRequest']);
    Route::post('cho-thue-sim',[Dealer::class,'rentSim']);
    Route::post('gia-han-hop-dong',[Dealer::class,'extendContract']);
    Route::post('khac-hang-moi-thue-sim',[Dealer::class,'rentSimNewCustomer']);
    Route::get('danh-sach-sim',[Dealer::class,'index']);
    Route::get('goi-cuoc',[PakageController::class,'userIndex']);
    Route::post('them-goi-cuoc',[PakageController::class,'storePartnerPackage']);
    Route::get('yeu-cau-sim',[SimCardController::class,'showRequest']);
    Route::post('send-request-sim',[SimCardController::class,'simRequest']);
    Route::get('doanh-thu',[ExportControlller::class,'index']);
    Route::get('get-bill-info/{id}',[SimCardController::class,'getBill']);
    Route::get('nhan-vien',[EmployeeController::class,'index']);
    Route::post('sua-nguoi-dung',[EmployeeController::class,'update']);
    Route::post('them-nguoi-dung',[EmployeeController::class,'store']);
    Route::post('phan-quyen',[EmployeeController::class,'permission']);
    Route::get('export-doanh-thu-hom-nay',[ExportControlller::class,'exportToday']);
    Route::get('export-doanh-thu-tuan-nay',[ExportControlller::class,'exportInWeek']);
    Route::get('export-doanh-thu-thang-nay',[ExportControlller::class,'exportInMonth']);
    Route::post('export-doanh-thu-tuy-chinh',[ExportControlller::class,'customExport']);

    Route::post('invite',[InviteController::class,'invite']);
    Route::get('export-sim',[ExportController::class,'exportPartner']);
});

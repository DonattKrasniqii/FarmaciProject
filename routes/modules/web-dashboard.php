<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\JiraController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','activityUser'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::put('user-info-update', [DashboardController::class, 'userInfoUpdate']);


    Route::group(['prefix' => 'drugs'], function () {
        Route::get('add-drug', [DrugsController::class, 'addDrugView']);
        Route::post('save-drug', [DrugsController::class, 'saveDrug']);
        Route::get('edit-drug/{id}', [DrugsController::class, 'editDrugView']);
        Route::get('delete-drug/{id}', [DrugsController::class, 'deleteDrug']);
        Route::put('update-drug', [DrugsController::class, 'updateDrug']);
        Route::get('accept-drug/{id}', [DrugsController::class, 'acceptDrug']);
        Route::get('dont-acceptDrug/{id}', [DrugsController::class, 'dontAcceptDrug']);
        Route::get('{id}/restoreDrug', [DrugsController::class, 'restore']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('advertise-type/{id}/{type}', [UserController::class, 'advertiseType']);
        Route::get('delete-user/{id}', [UserController::class, 'deleteUser']);
        Route::get('restore-user/{id}', [UserController::class, 'restore']);
        Route::get('deleteUserViews/{id}',[UserController::class,'viewsDelete']);
        Route::post('sendIssueJira',[JiraController::class,'store']);
        Route::get('changeUserStatus/{id}/{status}',[UserController::class,'userStatus']);
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::get('get-payment-informations', [PaymentsController::class, 'getPaymentInformations']);
        Route::post('save-payment', [PaymentsController::class, 'store']);
        Route::get('delete-payment/{id}', [PaymentsController::class, 'deletePayment']);
        Route::put('update-payment', [PaymentsController::class, 'update']);
        Route::get("printExcelData",[PaymentsController::class,'printExcelData']);
    });

    Route::group(['prefix' => 'blog'], function () {
        Route::post('save-blog', [BlogController::class, 'store']);
        Route::put('update-blog', [BlogController::class, 'update']);
        Route::get('featured-state/{id}/{type}', [BlogController::class, 'featuredState']);
    });

    Route::group(['prefix' => 'contact'], function () {
        Route::get('markRead/{id}', [ContactController::class, 'markasRead']);
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Inventory\ProductController;
use App\Http\Controllers\Api\Inventory\ProductCategoryController;
use App\Http\Controllers\Api\HR\EmployeeController;
use App\Http\Controllers\Api\DistrictsController;
use App\Http\Controllers\Api\LeaveApplication;
use App\Http\Controllers\Api\PayrollInvoiceController;
use App\Http\Controllers\Api\PayrollReceipt;
use App\Models\PayrollInvoice;

// find leaves
Route::get('/leave_count',[LeaveApplication::class,'getLeaveCount']);

//get salary config
Route::get('/get_salary_config',[PayrollInvoiceController::class,'getSalaryConfig']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::get('productcategory/{id}/filter',[ProductCategoryController::class,'filter']);

Route::apiResources([
    'employees'=>EmployeeController::class
]);
 Route::apiResources([
    'products' => ProductController::class,
]);

Route::apiResources([
    'productcategory'=>ProductCategoryController::class,
    
]);

// Route::apiResources([
//     'district'=>DistrictsController::class
// ]);
Route::apiResource('districts', districtsController::class);
Route::apiResource('payroll_receipt', PayrollReceipt::class);
Route::apiResource('payroll_invoices', PayrollInvoiceController::class);
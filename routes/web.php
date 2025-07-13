<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollInvoiceController;
use App\Http\Controllers\PayrollReceiptController;

Route::get('/', function () {
    return view('pages.dashboard.home');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.home');
})->name('dashboard');


// Route::get('/', function () {
//     return view('pages.about.index');
// });

Route::get('user', [UserController::class,"user"]);
Route::get('about', [AboutController::class,'index']);
Route::get('about', [AboutController::class,'index']);

Route::resource('products', ProductController::class);



Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('leave_applications', App\Http\Controllers\LeaveApplicationController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('bloods', App\Http\Controllers\BloodController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('attendanceMethods', App\Http\Controllers\AttendanceMethodController::class);
Route::resource('departments', App\Http\Controllers\DepartmentController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('attendanceReports', App\Http\Controllers\AttendanceReportController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('attendancemethods', App\Http\Controllers\AttendancemethodController::class);


// Route::resource('/invoices', App\Http\Controllers\PayrollInvoiceController::class);
Route::resource('payroll-invoices', PayrollInvoiceController::class);
Route::resource('payroll_receipts', PayrollReceiptController::class);





Route::resource('payroll_items', App\Http\Controllers\PayrollItemController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
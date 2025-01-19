<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\BopController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ItenaryController;
use App\Http\Controllers\MasterDropController;
use App\Http\Controllers\MasterPickupController;
use App\Http\Controllers\MasterPricelistController;
use App\Http\Controllers\MasterVehicle;
use App\Http\Controllers\MasterTourController;
use App\Http\Controllers\SpaceAddonController;
use App\Http\Controllers\SpaceDetailController;
use App\Http\Controllers\SpaceGalleryController;
use App\Http\Controllers\SpaceItenaryController;
use App\Http\Controllers\SpacePricelistController;
use App\Http\Controllers\TourDetailController;
use App\Http\Controllers\TourGalleryController;
use App\Http\Controllers\TourProductController;

Route::group([
    'prefix' => 'api'
], function () {
    Route::get('vehicle', [ContentController::class, 'listVehicle']);
    Route::get('pickup', [ContentController::class, 'pickupData']);
    Route::get('drop', [ContentController::class, 'dropData']);
    Route::get('pricelist/{vehicleId}/{pickupId}/{dropId}', [ContentController::class, 'getPrice']);
    // Route::get('tour', [ContentController::class, 'ggetTourData']);
    Route::get('tour-type', [ContentController::class, 'getTourType']);
    Route::get('tour-product', [ContentController::class, 'getTourProduct']);
    Route::get('space', [ContentController::class, 'getSpaceData']);
    Route::get('space-addon', [ContentController::class, 'getSpaceAddon']);
    Route::get('space-product/{space_detail_id}/{addons}', [ContentController::class, 'getSpaceProduct']);
});

Route::get('/', [AuthController::class, 'login'])->name('home');
Route::post('/login', [AuthController::class, 'auth'])->name('login.process');
Route::get('/welcome', [AuthController::class, 'index'])->name('welcome');

// Logout   
Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('home');
})->name('logout');

// Master Data
Route::prefix('master')->group(function () {
    Route::get('/', [AuthController::class, 'masterVehicle'])->name('master.index');
    Route::resource('/vehicle', MasterVehicle::class);
    Route::resource('/pickup', MasterPickupController::class);
    Route::resource('/drop', MasterDropController::class);
    Route::resource('/pricelist', MasterPricelistController::class);

    Route::resource('/tour', MasterTourController::class);
    Route::get('/tour-detail', [TourDetailController::class, 'index'])->name('tour-detail.index');
    Route::get('/tour-detail/create', [TourDetailController::class, 'create'])->name('tour-detail.create');
    Route::post('/tour-detail', [TourDetailController::class, 'store'])->name('tour-detail.store');
    Route::get('/tour-detail/{id}/edit', [TourDetailController::class, 'edit'])->name('tour-detail.edit');
    Route::put('/tour-detail/{id}', [TourDetailController::class, 'update'])->name('tour-detail.update');
    Route::post('/tour-gallery', [TourGalleryController::class, 'store'])->name('tour-gallery.store');
    Route::post('/itenary', [ItenaryController::class, 'store'])->name('itenary.store');
    Route::resource('/tour-product', TourProductController::class);

    Route::resource('/space-detail', SpaceDetailController::class);
    Route::post('/space-gallery', [SpaceGalleryController::class, 'store'])->name('space-gallery.store');
    Route::post('/space-itenary', [SpaceItenaryController::class, 'store'])->name('space-itenary.store');
    Route::resource('/space-addon', SpaceAddonController::class);
    Route::resource('/space-pricelist', SpacePricelistController::class);
});

// Employee
Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/{employeeId}/mark-attendance', [EmployeeController::class, 'markAttendance'])->name('employee.markAttendance');
    Route::post('/attendance/mark/{employee}', [EmployeeController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/attendance', [EmployeeController::class, 'attendance'])->name('attendance.index');
});

// Car 
Route::prefix('car')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('car.index');
    Route::get('/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/', [CarController::class, 'store'])->name('car.store');
    Route::get('/{id}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::put('/{id}', [CarController::class, 'update'])->name('car.update');
    Route::delete('/{id}', [CarController::class, 'destroy'])->withoutMiddleware('middleware_name')->name('car.destroy');
    Route::get('/status', [CarController::class, 'carStatus'])->name('car.status');
    Route::post('/save-and-redirect', [CarController::class, 'saveAndRedirect'])->name('car.saveAndRedirect');
});

//Order Report
Route::prefix('report')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('report.index');
    Route::get('/create', [ReportController::class, 'create'])->name('report.create');
    Route::post('/', [ReportController::class, 'store'])->name('report.store');
    Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('report.edit');
    Route::put('/{id}', [ReportController::class, 'update'])->name('report.update');
    Route::delete('/{id}', [ReportController::class, 'destroy'])->name('report.destroy');
});

//Maintenance
Route::prefix('maintenance')->group(function () {
    Route::get('/', [MaintenanceController::class, 'index'])->name('maintenance.index'); // Halaman utama Maintenance (index)
    Route::get('/create', [MaintenanceController::class, 'create'])->name('maintenance.create'); // Halaman untuk membuat data baru
    Route::post('/', [MaintenanceController::class, 'store'])->name('maintenance.store'); // Menyimpan data baru
    Route::get('/{id}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit'); // Halaman untuk mengedit data
    Route::put('/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update'); // Memperbarui data yang diubah
    Route::delete('/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy'); // Menghapus data
});

//BOP
Route::prefix('bop')->name('bop.')->group(function () {
    Route::get('/', [BopController::class, 'index'])->name('index');
    Route::get('create', [BopController::class, 'create'])->name('create');
    Route::post('store', [BopController::class, 'store'])->name('store');
    Route::delete('destroy/{id}', [BopController::class, 'destroy'])->name('destroy');
    Route::get('edit/{id}', [BopController::class, 'edit'])->name('edit'); // Route for editing
    Route::put('update/{id}', [BopController::class, 'update'])->name('update'); // Route for updating
});

//Daily
Route::prefix('daily-report')->name('daily_report.')->group(function () {
    Route::get('/', [DailyReportController::class, 'index'])->name('index');
    Route::get('create', [DailyReportController::class, 'create'])->name('create');
    Route::post('store', [DailyReportController::class, 'store'])->name('store');
    Route::delete('destroy/{id}', [DailyReportController::class, 'destroy'])->name('destroy');
    Route::get('edit/{id}', [DailyReportController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [DailyReportController::class, 'update'])->name('update');
});

//Driver
Route::prefix('driver')->name('driver.')->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('index');
    Route::get('create', [DriverController::class, 'create'])->name('create');
    Route::post('store', [DriverController::class, 'store'])->name('store');
    Route::delete('destroy/{id}', [DriverController::class, 'destroy'])->name('destroy');
    Route::get('edit/{id}', [DriverController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [DriverController::class, 'update'])->name('update');
});

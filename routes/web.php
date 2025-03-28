<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SesiController;
use App\Http\Middleware\UserAkses;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

// Route::get('/sales', function () {
//     return view('dashboard.sales_dashboard');
// });

Route::get('/404', function () {
    return view('404');
});


Route::middleware('guest')->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/sales', [Admincontroller::class, 'sales'])->middleware(UserAkses::class . ':sales');
    Route::get('/admin', [Admincontroller::class, 'admin'])->middleware(UserAkses::class . ':admin');
    Route::get('/superadmin', [Admincontroller::class, 'manage_admin'])->middleware(UserAkses::class . ':superadmin');
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::group(['prefix' => 'prospects'], function () {
    Route::get('/add-prospect', [ProspectController::class, 'add_prospect']);
    Route::post('/add-prospect', [ProspectController::class, 'add_prospect']);
    Route::get('/manage-prospects', [ProspectController::class, 'manage_prospects']);
    Route::get('/delete-prospect/{id}', [ProspectController::class, 'delete_prospect']);
    Route::get('/edit-prospect/{id}', [ProspectController::class, 'edit_prospect']);
    Route::post('/edit-prospect/{id}', [ProspectController::class, 'edit_prospect']);
    Route::get('/view-prospect/{id}', [ProspectController::class, 'view_prospect']);
    Route::get('/convert-prospect/{id}', [ProspectController::class, 'convert_prospect']);
    Route::post('/convert-prospect/{id}', [ProspectController::class, 'convert_prospect']);
});

Route::group(['prefix' => 'accounts'], function () {
    Route::get('/manage-accounts', [AccountController::class, 'manage_accounts']);
    Route::get('/add-account', [AccountController::class, 'add_account']);
    Route::post('/add-account', [AccountController::class, 'add_account']);
    Route::get('/edit-account/{id}', [AccountController::class, 'edit_account']);
    Route::post('/edit-account/{id}', [AccountController::class, 'edit_account']);
    Route::get('/delete-account/{id}', [AccountController::class, 'delete_account']);
});

Route::group(['prefix' => 'contacts'], function () {
    Route::get('/manage-contacts', [ContactController::class, 'manage_contacts']);
    Route::get('/add-contact', [ContactController::class, 'add_contact']);
    Route::post('/add-contact', [ContactController::class, 'add_contact']);
    Route::get('/edit-contact/{id}', [ContactController::class, 'edit_contact']);
    Route::post('/edit-contact/{id}', [ContactController::class, 'edit_contact']);
    Route::get('/delete-contact/{id}', [ContactController::class, 'delete_contact']);
});

Route::group(['prefix' => 'deals'], function () {
    Route::get('/manage-deals', [DealController::class, 'manage_deals']);
    Route::get('/add-deal', [DealController::class, 'add_deal']);
    Route::post('/add-deal', [DealController::class, 'add_deal']);
    Route::get('/delete-deal/{id}', [DealController::class, 'delete_deal']);
    Route::get('/edit-deal/{id}', [DealController::class, 'edit_deal']);
    Route::post('/edit-deal/{id}', [DealController::class, 'edit_deal']);
});

Route::group(['prefix' => 'sales'], function () {
    Route::get('/manage-sales', [SalesController::class, 'manage_sales']);
    Route::get('/add-sales', [SalesController::class, 'add_sales']);
    Route::post('/add-sales', [SalesController::class, 'add_sales']);
    Route::get('/delete-sales/{id}', [SalesController::class, 'delete_sales']);
    Route::get('/edit-sales/{id}', [SalesController::class, 'edit_sales']);
    Route::post('/edit-sales/{id}', [SalesController::class, 'edit_sales']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/add-admin', [Admincontroller::class, 'add_admin']);
    Route::post('/add-admin', [Admincontroller::class, 'add_admin']);
    Route::get('/delete-admin/{id}', [Admincontroller::class, 'delete_admin']);
    Route::get('/edit-admin/{id}', [Admincontroller::class, 'edit_admin']);
    Route::post('/edit-admin/{id}', [Admincontroller::class, 'edit_admin']);
});

Route::get('/sales', [Admincontroller::class, 'sales']);

Route::get('/sales/data', [Admincontroller::class, 'getSalesData']);


Route::get('/reports/chart-data/{id}', [ReportController::class, 'getChartData']);




Route::group(['prefix' => 'reports'], function () {
    Route::get('/reports-sales', [ReportController::class, 'reports_sales']);
    Route::get('/view-report/{id}', [ReportController::class, 'view_report']);
    Route::get('/details-deals/{user_id}', [ReportController::class, 'details_deals']);
    Route::get('/details-accounts/{user_id}', [ReportController::class, 'details_accounts']);
    Route::get('/details-contacts/{user_id}', [ReportController::class, 'details_contacts']);
    Route::get('/details-prospects/{user_id}', [ReportController::class, 'details_prospects']);
    Route::get('/reports-prospects', [ReportController::class, 'reports_prospects']);
    Route::get('/reports-accounts', [ReportController::class, 'reports_accounts']);
    Route::get('/reports-contacts', [ReportController::class, 'reports_contacts']);
    Route::get('/reports-deals', [ReportController::class, 'reports_deals']);
});

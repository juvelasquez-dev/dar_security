<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Arbos\ArbosDashboardController;
use App\Http\Controllers\Arbos\SellerController;
use App\Http\Controllers\Arbos\ProductsController;
use App\Http\Controllers\Arbos\SalesReportController;
use App\Http\Controllers\Arbos\OrdersController;
use App\Http\Controllers\Arbos\ProfileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Arbos\BuyerController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SalesReportController as SuperAdminSalesReportController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Carpos\DashboardController as CarposDashboardController;
use App\Http\Controllers\Carpos\CarposManagementController;
use App\Http\Controllers\Carpos\ArboAdminController;
use App\Http\Controllers\Carpos\MarketMonitoringController;
use App\Http\Controllers\SuperAdmin\UserRoleController;
use App\Http\Controllers\SuperAdmin\PendingUsersController;
use App\Http\Controllers\SuperAdmin\RegisterCarposController;
use App\Http\Controllers\SuperAdmin\PbdController;
use App\Http\Controllers\SuperAdmin\ActivityLogsController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Forgot password (send reset link)
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Password reset form (link from email) and update
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');
// Registration routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Social Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [\App\Http\Controllers\Auth\SocialController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\SocialController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
Route::get('/super-admin/dashboard', [SuperAdminDashboardController::class, 'index'])->name('super.admin.dashboard');
Route::get('/admin/dashboard', [CarposDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/arbos/dashboard', [ArbosDashboardController::class, 'index'])->name('arbos.dashboard');
// Finance dashboard
Route::get('/finance/dashboard', [\App\Http\Controllers\Finance\DashboardController::class, 'index'])->name('finance.dashboard');

// Super Admin: Profile
Route::get('/profile', [\App\Http\Controllers\SuperAdmin\ProfileController::class, 'index'])->name('profile');
Route::patch('/profile', [\App\Http\Controllers\SuperAdmin\ProfileController::class, 'update'])->name('profile.update');
Route::patch('/profile/password', [\App\Http\Controllers\SuperAdmin\ProfileController::class, 'password'])->name('profile.password');

Route::get('/admin-carpos/dashboard', [AdminDashboardController::class, 'index'])->name('admin.carpos.dashboard');

// CARPOS: ARBO management listing
Route::get('/admin/arbos', [CarposManagementController::class, 'index'])->name('admin.arbos.index');

// CARPOS: ARBO admins management
Route::get('/admin/arbo-admins', [ArboAdminController::class, 'index'])->name('admin.arbo.admins');

// CARPOS: Marketplace monitoring
Route::get('/admin/marketplace', [MarketMonitoringController::class, 'index'])->name('admin.marketplace');

// Super Admin: Sales report
Route::get('/reports', [SuperAdminSalesReportController::class, 'index'])->name('superadmin.salesreport');
Route::get('/super-admin/user-roles', [UserRoleController::class, 'index'])->name('super_admin.user_roles.index');
Route::post('/super-admin/user-roles', [UserRoleController::class, 'store'])->name('super_admin.user_roles.store');
// Super Admin: User roles management
Route::get('/roles', [UserRoleController::class, 'index'])->name('superadmin.roles');

// Super Admin: Branches
Route::get('/branches/create', [RegisterCarposController::class, 'create'])->name('branches.create');
Route::get('/branches', [PbdController::class, 'index'])->name('superadmin.pbd');
Route::get('/branches/{branch}', [RegisterCarposController::class, 'manage'])->name('branches.manage');

// Super Admin: Activity logs
Route::get('/logs', [ActivityLogsController::class, 'index'])->name('superadmin.logs');

// Super Admin: Pending user verification
Route::get('/superadmin/pending-users', [PendingUsersController::class, 'index'])->name('superadmin.pending.users');
Route::post('/superadmin/pending-users/{user}/verify', [PendingUsersController::class, 'verify'])->name('superadmin.pending.verify');

/*
|--------------------------------------------------------------------------
| ARBOS Routes
|--------------------------------------------------------------------------
*/

Route::prefix('arbos')
    ->name('arbos.')
    ->group(function () {
        Route::get('/dashboard', [ArbosDashboardController::class, 'index'])->name('dashboard');
        Route::get('/sellers', [SellerController::class, 'index'])->name('sellers');
        Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers');
        Route::get('/products', [ProductsController::class, 'index'])->name('products');
        Route::get('/reports', [SalesReportController::class, 'index'])->name('reports');
        Route::get('/reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');
        Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    });

// Singular `arbo/*` paths are used in ARBO dashboard templates — keep backward-compatible routes
Route::get('/arbo/dashboard', [ArbosDashboardController::class, 'index']);
Route::get('/arbo/sellers', [SellerController::class, 'index']);
Route::get('/arbo/buyers', [BuyerController::class, 'index']);
Route::get('/arbo/products', [ProductsController::class, 'index']);
Route::get('/arbo/reports', [SalesReportController::class, 'index']);
Route::get('/arbo/reports/sales', [SalesReportController::class, 'index']);
Route::get('/arbo/orders', [OrdersController::class, 'index']);
Route::get('/arbo/profile', [ProfileController::class, 'index']);
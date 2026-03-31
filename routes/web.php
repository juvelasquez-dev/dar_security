<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;

// ARBOS
use App\Http\Controllers\Arbos\ArbosDashboardController;
use App\Http\Controllers\Arbos\SellerController;
use App\Http\Controllers\Arbos\ProductsController;
use App\Http\Controllers\Arbos\SalesReportController;
use App\Http\Controllers\Arbos\OrdersController;
use App\Http\Controllers\Arbos\ProfileController;
use App\Http\Controllers\Arbos\BuyerController;

// SUPER ADMIN
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SalesReportController as SuperAdminSalesReportController;
use App\Http\Controllers\SuperAdmin\UserRoleController;
use App\Http\Controllers\SuperAdmin\PendingUsersController;
use App\Http\Controllers\SuperAdmin\RegisterCarposController;
use App\Http\Controllers\SuperAdmin\PbdController;
use App\Http\Controllers\SuperAdmin\ActivityLogsController;

// PBD / CARPOS
use App\Http\Controllers\Carpos\DashboardController as CarposDashboardController;
use App\Http\Controllers\Carpos\CarposManagementController;
use App\Http\Controllers\Carpos\ArboAdminController;
use App\Http\Controllers\Carpos\MarketMonitoringController;
use App\Http\Controllers\Carpos\ProfileController as CarposProfileController;

// FINANCE
use App\Http\Controllers\Finance\DashboardController as FinanceDashboardController;
use App\Http\Controllers\Finance\OrdersController as FinanceOrdersController;
use App\Http\Controllers\Finance\PaymentController as FinancePaymentController;
use App\Http\Controllers\Finance\RevenueController as FinanceRevenueController;
use App\Http\Controllers\Finance\ProfileController as FinanceProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingPageController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Login verification (code sent to email)
Route::get('/login/verify', [\App\Http\Controllers\AuthController::class, 'showVerifyForm'])->name('login.verify');
Route::post('/login/verify', [\App\Http\Controllers\AuthController::class, 'verifyCode'])->name('login.verify.post');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (AUTH + NO BACK HISTORY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', \App\Http\Middleware\PreventBackHistory::class])->group(function () {

    // Generic dashboard shortcut: redirect users to the appropriate dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $role = $user->role->slug ?? null;

        switch ($role) {
            case 'super_admin':
                return redirect()->route('super.admin.dashboard');
            case 'pbd':
                return redirect()->route('admin.dashboard');
            case 'finance':
                return redirect()->route('finance.dashboard');
            case 'arbo':
                return redirect()->route('arbos.dashboard');
            default:
                return redirect()->route('profile');
        }
    })->name('dashboard');


    /*
    |-------------------------------
    | SUPER ADMIN
    |-------------------------------
    */
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':super_admin'])->group(function () {

        Route::get('/super-admin/dashboard', [SuperAdminDashboardController::class, 'index'])
            ->name('super.admin.dashboard');

        Route::get('/profile', [\App\Http\Controllers\SuperAdmin\ProfileController::class, 'index'])->name('profile');
        Route::patch('/profile', [\App\Http\Controllers\SuperAdmin\ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password', [\App\Http\Controllers\SuperAdmin\ProfileController::class, 'password'])->name('profile.password');

        Route::get('/reports', [SuperAdminSalesReportController::class, 'index'])->name('superadmin.salesreport');

        Route::get('/super-admin/user-roles', [UserRoleController::class, 'index'])->name('super_admin.user_roles.index');
        Route::post('/super-admin/user-roles', [UserRoleController::class, 'store'])->name('super_admin.user_roles.store');
        Route::patch('/super-admin/user-roles/{user}', [UserRoleController::class, 'update'])->name('super_admin.user_roles.update');
        Route::patch('/super-admin/user-roles/{user}/activate', [UserRoleController::class, 'activate'])->name('super_admin.user_roles.activate');
        Route::patch('/super-admin/user-roles/{user}/deactivate', [UserRoleController::class, 'deactivate'])->name('super_admin.user_roles.deactivate');

        Route::get('/roles', [UserRoleController::class, 'index'])->name('superadmin.roles');

        Route::get('/branches/create', [RegisterCarposController::class, 'create'])->name('branches.create');
        Route::get('/branches', [PbdController::class, 'index'])->name('superadmin.pbd');
        Route::patch('/super-admin/pbd-management/{province}/assign-admin', [PbdController::class, 'assignAdmin'])->name('superadmin.pbd.assign');
        Route::get('/branches/{branch}', [RegisterCarposController::class, 'manage'])->name('branches.manage');

        Route::get('/logs', [ActivityLogsController::class, 'index'])->name('superadmin.logs');

        Route::get('/superadmin/pending-users', [PendingUsersController::class, 'index'])->name('superadmin.pending.users');
        Route::post('/superadmin/pending-users/{user}/verify', [PendingUsersController::class, 'verify'])->name('superadmin.pending.verify');
    });

    /*
    |-------------------------------
    | PBD / CARPOS
    |-------------------------------
    */
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':pbd'])->group(function () {

        Route::get('/admin/dashboard', [CarposDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/profile', [CarposProfileController::class, 'index'])->name('admin.profile');

        Route::get('/admin/arbos', [CarposManagementController::class, 'index'])->name('admin.arbos.index');
        Route::get('/admin/arbo-admins', [ArboAdminController::class, 'index'])->name('admin.arbo.admins');
        Route::get('/admin/marketplace', [MarketMonitoringController::class, 'index'])->name('admin.marketplace');
    });

    /*
    |-------------------------------
    | FINANCE
    |-------------------------------
    */
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':finance'])->group(function () {

        Route::get('/finance/dashboard', [FinanceDashboardController::class, 'index'])
            ->name('finance.dashboard');

        // Finance orders routes
        Route::get('/finance/orders', [FinanceOrdersController::class, 'index'])->name('finance.orders.index');
        Route::get('/finance/orders/{id}', [FinanceOrdersController::class, 'show'])->name('finance.orders.show');

        // Placeholder routes for other finance pages used in the dashboard
        Route::get('/finance/payments', [FinancePaymentController::class, 'index'])->name('finance.payments.index');
        Route::get('/finance/revenue', [FinanceRevenueController::class, 'index'])->name('finance.revenue.index');
            Route::get('/finance/profile', [FinanceProfileController::class, 'index'])->name('finance.profile');
        Route::get('/finance/reports/sales', function () { return view('finance.reports.reports'); })->name('finance.reports.sales');
       
        Route::get('/finance/activity-logs', function () { return redirect()->route('finance.dashboard'); })->name('finance.activity-logs');
    });

    /*
    |-------------------------------
    | ARBO
    |-------------------------------
    */
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':arbo'])->group(function () {

        Route::prefix('arbos')->name('arbos.')->group(function () {
            Route::get('/dashboard', [ArbosDashboardController::class, 'index'])->name('dashboard');
            Route::get('/sellers', [SellerController::class, 'index'])->name('sellers');
            Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers');
            Route::get('/products', [ProductsController::class, 'index'])->name('products');
            Route::get('/reports', [SalesReportController::class, 'index'])->name('reports');
            Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        });

        // backward compatibility
        Route::get('/arbo/dashboard', [ArbosDashboardController::class, 'index']);
        Route::get('/arbo/sellers', [SellerController::class, 'index']);
        Route::get('/arbo/buyers', [BuyerController::class, 'index']);
        Route::get('/arbo/products', [ProductsController::class, 'index']);
        Route::get('/arbo/reports', [SalesReportController::class, 'index']);
        Route::get('/arbo/orders', [OrdersController::class, 'index']);
        Route::get('/arbo/profile', [ProfileController::class, 'index']);
    });

});
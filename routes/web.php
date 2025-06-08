<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\User\UserController;

// Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\User\NotificationController;

// Operator Controller
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\User\ItemController as UserItemController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;

// User Controller
use App\Http\Controllers\Operator\ItemController as OperatorItemController;
use App\Http\Controllers\Admin\UserController as AdminUserManagementController;
use App\Http\Controllers\User\BorrowRequestController as UserBorrowRequestController;
use App\Http\Controllers\Operator\BorrowRequestController as OperatorBorrowRequestController;

Route::get('/', function () {
    return view('welcome-page');
});

Route::get('/login', [AuthenticationController::class, 'showFormLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

// Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // Route::get('/users', [AdminController::class, 'manageUsers'])->name('users.index');
        Route::resource('users', AdminUserManagementController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('items', AdminItemController::class);
});

// Operator
Route::middleware(['auth', RoleMiddleware::class . ':operator'])
    ->prefix('operator')->name('operator.')->group(function () {
        Route::get('/dashboard', [OperatorController::class, 'dashboard'])->name('dashboard');
        Route::get('/requests', [OperatorController::class, 'listRequests'])->name('requests.index'); 
        Route::get('/items', [OperatorItemController::class, 'index'])->name('items.index');
        Route::patch('/items/{item}/status', [OperatorItemController::class, 'updateStatus'])->name('items.updateStatus');
        Route::get('/requests', [OperatorBorrowRequestController::class, 'index'])->name('requests.index');
        Route::patch('/requests/{borrowRequest}/approve', [OperatorBorrowRequestController::class, 'approve'])->name('requests.approve');
        Route::patch('/requests/{borrowRequest}/reject', [OperatorBorrowRequestController::class, 'reject'])->name('requests.reject');
        Route::patch('/requests/{borrowRequest}/borrowed', [OperatorBorrowRequestController::class, 'markAsBorrowedOut'])->name('requests.markBorrowed');
        Route::patch('/requests/{borrowRequest}/return', [OperatorBorrowRequestController::class, 'markAsReturned'])->name('requests.return');
        Route::get('/borrower-history', [OperatorBorrowRequestController::class, 'borrowerHistory'])->name('borrower.history.index');
        Route::post('/borrower-history/{borrowRequest}/send-reminder', [OperatorBorrowRequestController::class, 'sendReturnReminder'])->name('borrower.send-reminder');
});

// User
Route::middleware(['auth', RoleMiddleware::class . ':user'])
    ->prefix('user')->name('user.')->group(function () {
        Route::get('/home', [UserController::class, 'homepage'])->name('home');
        Route::get('/items', [UserItemController::class, 'index'])->name('items.index');
        Route::get('/my-requests', [UserController::class, 'myRequests'])->name('pending');
        Route::get('/borrow/create', [UserBorrowRequestController::class, 'create'])->name('borrow.create');
        Route::post('/borrow', [UserBorrowRequestController::class, 'store'])->name('borrow.store');
        Route::delete('/borrow-requests/{borrowRequest}/cancel', [UserBorrowRequestController::class, 'cancel'])->name('borrow.cancel');
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/mark-as-read/{notification}', [NotificationController::class, 'markAsRead'])->name('markAsRead');
            Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
        });
});
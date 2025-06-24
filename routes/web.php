<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

// หน้า public ไม่ต้องล็อกอิน
Route::get('/', function () {
    return view('ebook.home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/resetpass', function () {
    return view('auth.resetpass');
})->name('resetpass');

// Auth Actions
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// กลุ่ม route ที่ต้องล็อกอิน
Route::middleware(\App\Http\Middleware\CheckSessionLogin::class)->group(function () {
    Route::get('/profile', function () {
        return view('auth.profile');
    })->name('profile');

    // User E-book Pages
    Route::get('/mybook', function () {
        return view('ebook.mybook');
    })->name('mybook');

    Route::get('/bookdetail', function () {
        return view('ebook.bookdetail');
    })->name('bookdetail');

    Route::get('/transection', function () {
        return view('ebook.transection');
    })->name('transection');

    // Admin Pages (เฉพาะ admin)
    Route::middleware(\App\Http\Middleware\AdminOnly::class)->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('/book', function () {
            return view('admin.book');
        })->name('book');

        // User Management
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        // Admin Dashboard
        Route::get('/transaction', function () {
            return view('admin.transaction');
        })->name('transaction');
        Route::get('/report', function () {
            return view('admin.report');
        })->name('report');
        // Category Management
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        // Book Management
        Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/book', [BookController::class, 'store'])->name('book.store');
        Route::get('/book', [BookController::class, 'index'])->name('book');
        Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
        Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
        Route::get('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
        Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::patch('/book/{id}', [BookController::class, 'update'])->name('book.update');

        // User Management
        
    });
});



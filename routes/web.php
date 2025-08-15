<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Book;
use App\Http\Middleware\CheckAdmin;



Route::get('/', function () {
    $books = Book::all();
    return view('welcome', compact('books'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//////Admin Permissions//////
Route::group(['middleware' => ['auth', CheckAdmin::class]], function ()
{
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/profile', [AuthenticatedSessionController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AuthenticatedSessionController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/books', [BookController::class, 'index'])->name('admin.books.index');
    Route::get('/admin/books/borrowed', [BookController::class, 'borrowed'])->name('admin.books.borrowed');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/admin/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/admin/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/admin/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/admin/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/admin/users/search', [UserController::class, 'searchByStudentId'])->name('users.search');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');

    //Route::resource('/admin/books', BookController::class);
    //Route::resource('/admin/users', UserController::class)->only(['index','show']);
});



//////Student Permissions//////
Route::get('/register', [AuthenticatedSessionController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticatedSessionController::class, 'register'])->name('register.submit');

Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->middleware('auth')->name('student.dashboard');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::post('/books/{id}/borrow', [BorrowController::class, 'borrow'])->name('books.borrow')->middleware('auth');

Route::patch('/books/{id}/return', [BorrowController::class, 'return'])->name('books.return');

Route::get('/student/borrows', [BorrowController::class, 'borrows'])->name('student.borrows');

Route::get('/student/profile', [ProfileController::class, 'edit'])->name('student.profile.edit');
Route::patch('/student/profile', [ProfileController::class, 'update'])->name('student.profile.update');



require __DIR__.'/auth.php';
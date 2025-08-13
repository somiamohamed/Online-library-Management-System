<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Book;


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
Route::group(['middleware' => ['auth', 'check_admin']], function () 
{
    Route::get('/admin', function () { 
    return view('admin.dashboard'); })->name('admin.dashboard');
    
    Route::get('/admin/profile', [AuthenticatedSessionController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AuthenticatedSessionController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/books', [BookController::class, 'index']);
    Route::get('/admin/books/borrowed', [BookController::class, 'borrowed'])->name('books.borrowed');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('books.create'); 
    Route::post('/admin/books', [BookController::class, 'store'])->name('books.store');    
    Route::get('/admin/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/admin/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/admin/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');


    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/search', [UserController::class, 'searchByStudentId'])->name('users.search');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');

    //Route::resource('/admin/books', BookController::class);
    //Route::resource('/admin/users', UserController::class)->only(['index','show']);
});



//////Student Permissions//////
Route::get('/register', [AuthenticatedSessionController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticatedSessionController::class, 'register'])->name('register.submit');

Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::post('/books/{id}/borrow', [BorrowController::class, 'borrow'])->name('books.borrow')->middleware('auth');

Route::patch('/books/{id}/return', [BorrowController::class, 'return'])->name('books.return');

Route::get('/student/borrows', [BorrowController::class, 'history'])->name('student.borrows');

Route::get('/student/profile', [StudentController::class, 'editProfile'])->name('student.profile.edit');
Route::patch('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');



require __DIR__.'/auth.php';

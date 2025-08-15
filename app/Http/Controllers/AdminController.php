<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $books = Book::paginate(9);
        $borrowedBooks = Book::where('status', 'borrowed')->paginate(9);
        $users = User::paginate(9);

        return view('admin.dashboard', compact('books', 'borrowedBooks', 'users'));
    }

    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $borrowedBooks = Borrow::whereNull('returned_at')->count();

        $recentBooks = Book::latest()->take(3)->get();
        $recentUsers = User::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers',
            'borrowedBooks',
            'recentBooks',
            'recentUsers'
        ));
    }
}
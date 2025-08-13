<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $books = Book::paginate(10);
        $borrowedBooks = Book::where('status', 'borrowed')->paginate(10);
        $users = User::paginate(10);

        return view('admin.dashboard', compact('books', 'borrowedBooks', 'users'));
    }
}
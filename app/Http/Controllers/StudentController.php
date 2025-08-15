<?php

namespace App\Http\Controllers;
use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user();  

        if ($student->role !== 'student') 
        {
            abort(403, 'Unauthorized action.');
        }

        
        $borrowedBooks = Borrow::with('book')
        ->where('user_id', $student->id)
        ->whereNull('returned_at')
        ->paginate(5);

        $borrowHistory = Borrow::with('book')
        ->where('user_id', $student->id)
        ->whereNotNull('returned_at')
        ->paginate(5);

        $borrowedBooksCount = $borrowedBooks->count();

        $availableBooksCount = Book::whereDoesntHave('borrows', function ($query) 
        { $query->whereNull('returned_at'); })->count();

        return view('student.dashboard', compact('student', 'borrowedBooks', 'borrowedBooksCount', 'availableBooksCount', 'borrowHistory'))
            ->with('success', session('success'))
            ->with('error', session('error'));    
    }
}

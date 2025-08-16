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
        ->paginate(3);

        $borrowHistory = Borrow::with('book')
        ->where('user_id', $student->id)
        ->whereNotNull('returned_at')
        ->paginate(3);

        $borrowedBooksCount = Borrow::where('user_id', $student->id)
        ->whereNull('returned_at')
        ->count();

        $availableBooksCount = Book::where('status', 'available')->count();

        return view('student.dashboard', compact
        (
        'student',
        'borrowedBooks',
        'borrowHistory',
        'borrowedBooksCount',
        'availableBooksCount'
        ));    
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function borrow($book_id) 
    {
        $book = Book::findOrFail($book_id);
        if ($book->status === 'borrowed') 
        {
            return redirect()->back()->with('error', 'This book is already borrowed.');
        }

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        $book->update(['status' => 'borrowed']);
        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }
         
    public function return($book_id) 
    {
        $book = Book::findOrFail($book_id);

        $borrow = Borrow::where('book_id', $book->id)
            ->where('user_id', Auth::id())
            ->where('status', 'borrowed')
            ->whereNull('returned_at')
            ->first();

        if (!$borrow) {
            return redirect()->back()->with('error', 'You have not borrowed this book or it is already returned.');
        }

        $borrow->update([
            'returned_at' => now(),
            'status' => 'returned'
        ]);

        $book->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Book returned successfully!');
    }

    public function history() 
    {
        $borrows = Borrow::with('book')
        ->where('user_id', Auth::id())
        ->orderBy('borrowed_at', 'desc')
        ->get();

        return view('student.borrows', compact('borrows'));
    }         

    public function allBorrows() 
    {
        $borrows = Borrow::with(['book', 'user'])
        ->orderBy('borrowed_at', 'desc')
        ->get();

        return view('admin.borrows', compact('borrows'));
    }     
}
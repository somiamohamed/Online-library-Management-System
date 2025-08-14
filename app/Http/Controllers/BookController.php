<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() 
    {
        $books = Book::paginate(9);
        return view('books.index', compact('books'));
    } 
    
    public function show($id) 
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }     

    public function create() 
    {
        return view('admin.books.create');
    }   

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_url' => 'nullable|url',
        ]);

        Book::create($validated + ['status' => 'available']);
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function edit($id) 
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }  

    public function update(Request $request, $id) 
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_url' => 'nullable|url',
            'status' => 'in:available,borrowed',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy($id) 
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }   

    public function borrowed() 
    {
        $books = Book::where('status', 'borrowed')->get();
        return view('admin.books.borrowed', compact('books'));
    }    
}


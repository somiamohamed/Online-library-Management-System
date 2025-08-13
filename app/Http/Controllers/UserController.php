<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show($id) 
    {
        $user = User::find($id);        
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        return view('admin.users.show', compact('user'));    
    }

    public function searchByStudentId(Request $request) 
    {
        $request->validate(['student_id' => 'required|string']);
        $user = User::where('student_id', $request->student_id)->first();

        if (!$user) 
        {
            return redirect()->route('users.index')->with('error', 'Student not found.');
        }

        return redirect()->route('users.show', $user->id);
    }
}

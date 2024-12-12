<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
        $this->middleware('admin'); // Ensure user is an admin
    }

    public function createAdminForm()
    {
        return view('admin.create-admin'); // Create a view for admin creation form
    }

    public function storeAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => true, // Mark as admin
        ]);

        return redirect()->route('dashboard')->with('success', 'Admin created successfully!');
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    // Display a list of all users
    public function index()
    {
        // Retrieve all users from the database, paginated
        $users = User::all(); // Adjust the number as needed

        // Pass the users data to the view
        return view('pages.user-management', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('pages.user-create'); // Create a view for creating a user
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'firstname' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'nullable|string|min:8|confirmed', // Make password optional
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'country' => 'nullable|string|max:100',
        'postal' => 'nullable|string|max:20',
        'about' => 'nullable|string|max:255',
        'role' => 'required|string|in:user,admin', // Ensure role is either user or admin
    ]);

    // Create user with validated data
    User::create([
        'username' => $validatedData['username'],
        'firstname' => $validatedData['firstname'],
        'lastname' => $validatedData['lastname'],
        'email' => $validatedData['email'],
        // Hash password only if it's provided
        'password' => !empty($validatedData['password']) ? bcrypt($validatedData['password']) : null,
        'address' => $validatedData['address'],
        'city' => $validatedData['city'],
        'country' => $validatedData['country'],
        'postal' => $validatedData['postal'],
        'about' => $validatedData['about'],
        'role' => $validatedData['role'],
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    // Show the specified user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user-show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user-edit', compact('user')); // Create a view for editing a user
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        'firstname' => ['max:100'],
        'lastname' => ['max:100'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'address' => ['max:255'],
        'city' => ['max:100'],
        'country' => ['max:100'],
        'postal' => ['max:20'],
        'about' => ['max:255'],
        'role' => ['required', 'string', 'in:user,admin'], // Ensure role is either user or admin
    ]);

    // Update user with validated data
    $user->update([
        'username' => $validatedData['username'],
        'firstname' => $validatedData['firstname'],
        'lastname' => $validatedData['lastname'],
        'email' => $validatedData['email'],
        // Only hash the password if a new one is provided
        'password' => !empty($request->password) ? bcrypt($request->password) : $user->password,
        'address' => $validatedData['address'],
        'city' => $validatedData['city'],
        'country' => $validatedData['country'],
        'postal' => $validatedData['postal'],
        'about' => $validatedData['about'],
        'role' => $validatedData['role'],
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->user()->id) {
            return redirect()->route('users.index')->with('error', "You can't delete your own account.");
        }

        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
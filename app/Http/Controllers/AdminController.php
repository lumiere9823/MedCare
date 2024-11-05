<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $role = $request->input('role');
        $search = $request->input('search');

        $users = User::when($role, function ($query, $role) {
                return $query->where('role', $role);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10); 

    return view('admin.dashboard', compact('users', 'role', 'search'));
    }

    public function editUser(User $user)
    {
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'role' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->time_slot = $request->time_slot;
        $user->save(); 
        return redirect()->route('administrator.dashboard')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        // Logic to delete user
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('administrator.dashboard')->with('success', 'User deleted successfully.');
    }

    public function createUser()
    {
        return view('admin.createUser');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'time_slot' => $request->time_slot,
        ]);

        return redirect()->route('administrator.dashboard')->with('success', 'User created successfully.');
    }

    public function manageHealthData()
    {
        // Logic to manage health data
        return view('admin.manageHealthData');
    }
}
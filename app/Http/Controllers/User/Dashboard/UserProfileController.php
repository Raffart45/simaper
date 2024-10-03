<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Corrected method
        return view('user.dashboard.profile.show', compact('user'));
    }
    
    public function edit()
    {
        $user = Auth::user(); // Corrected method
        return view('user.dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = Auth::user(); // Correct method to get authenticated user

        // Ensure $user is an instance of User model
        if (!$user instanceof User) {
            abort(403, 'Unauthorized action.');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('user.profile.show')->with('success', 'Profile updated successfully.');
    }
}

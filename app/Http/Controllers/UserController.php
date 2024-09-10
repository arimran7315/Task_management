<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $managers = User::where('status', 0)->get();
        return view('pendingApprovel', compact('managers'));
    }
    public function update(string $id)
    {
        User::where('id', $id)->update([
            'status' => 1
        ]);
        return redirect()->route('index');
    }
    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required'
        ], [
            'name.required' => 'Field is required',
            'email.required' => 'Field is required',
            'email.unique' => 'email is already taken',
            'password.required' => 'Field is required',
            'password.confirmed' => 'Password is not matched',
            'role.required' => 'select a role'
        ]);
        if ($request->role == 'Manager') {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'status' => '0'
            ]);
            return redirect()->route('login')->with([
                'type' => 'info',
                'message' => 'Account was successfully created Wait for Admin Approvel',
            ]);
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'status' => '1'
            ]);
            return redirect()->route('login')->with([
                'type' => 'success',
                'message' => 'Account was successfully created',
            ]);
        }
    }
    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Field is required',
            'password.required' => 'Field is required'
        ]);
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'Manager') {
                if (Auth::user()->status == 0) {
                    return redirect()->back()->with([
                        'type' => 'danger',
                        'message' => 'Admin is not Approved your account yet'
                    ]);
                } else {
                    $managers = User::whereStatus(0)->get();
                    return redirect()->route('index');
                }
            } else {
                $managers = User::whereStatus(0)->get();
                return redirect()->route('index');
            }
        }else{
            return redirect()->back()
            ->with([
                'type' => 'danger',
                'message' => 'Invalid Credentials'
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

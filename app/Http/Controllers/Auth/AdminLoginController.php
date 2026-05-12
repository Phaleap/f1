<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function create()
{
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('auth.admin-login');
}

public function store(Request $request)
{
    $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Invalid admin credentials.',
        ]);
    }

    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

public function destroy(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}
}
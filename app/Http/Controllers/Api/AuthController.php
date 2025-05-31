<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|in:customer,tailor',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    // Default null
    $photoPath = null;

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'pp' => $photoPath,  
    ]);

    return redirect('/login')->with('success', 'Pendaftaran berhasil, silakan login.');
}

    public function showLoginForm()
    {
        return view('auth.login');
    }
   public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
        $user = Auth::user(); // otomatis tersimpan di session

        if ($user->role === 'tailor') {
            return redirect('/profile');
        } else {
            return redirect('/');
        }
    }


        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    

public function logout()
{
    Auth::logout(); // hapus session login
    return redirect('/login');
}

    public function showResetForm()
    {
        return view('auth.passworreset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset!');
    }
}


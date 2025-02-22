<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        // Validasi input dari $request menggunakan Validator
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|unique:users|regex:/^[0-9]{10,15}$/',
            'password' => 'required|confirmed'
        ])->validate();

        // Simpan data user baru ke database menggunakan model User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => "0" // Asumsi bahwa 'type' 0 adalah untuk pengguna reguler
        ]);

        // Redirect pengguna ke halaman login setelah berhasil registrasi
        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        // Validasi input dari $request menggunakan Validator
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // Memeriksa kecocokan data login dengan Auth::attempt()
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Jika tidak cocok, lempar ValidationException dengan pesan error
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        // Regenerasi session untuk menghindari session fixation
        $request->session()->regenerate();

         // Redirect sesuai dengan jenis user setelah login
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin/home');
        } else {
            return redirect()->route('home');
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // Logout pengguna menggunakan Auth::guard('web')->logout()
        Auth::guard('web')->logout();

        // Invalidate session
        $request->session()->invalidate();

        // Redirect pengguna ke halaman '/home'
        return redirect('/home');
    }
}

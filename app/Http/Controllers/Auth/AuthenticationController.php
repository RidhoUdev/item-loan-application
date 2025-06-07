<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{

    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login_identifier' => 'required|string',
            'password' => 'required|string',
        ],[
            'login_identifier.required' => 'Email atau username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput($request->only('login_identifier'));
        }

        $loginInput = $request->input('login_identifier');
        $passwordInput = $request->input('password');
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


        $user = User::where($fieldType, $loginInput)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'login_identifier' => ['Email atau username yang Anda masukkan salah.'],
            ]);
        }

        $credentials = [
            $fieldType => $loginInput,
            'password' => $passwordInput,
        ];

        $remember = $request->boolean('remember'); 

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $loggedInUser = Auth::user();

            if ($loggedInUser->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($loggedInUser->role === 'operator') {
                return redirect()->intended(route('operator.dashboard'));
            } else {
                return redirect()->intended(route('user.home'));
            }

        }

        throw ValidationException::withMessages([
            'password' => ['Password yang Anda masukkan salah.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}

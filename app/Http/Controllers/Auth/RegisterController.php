<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $provinces = User::getProvinceOptions();
        return view('auth.register', [
            "title" => "Register",
            "provinces" => $provinces,
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);
        Subscription::create([
            'user_id' => $user->id
        ]);
        
        if (Auth::login($user)) {
            return redirect()->route('home');
        } 
        
        return redirect()->route('login')->withErrors(['login' => 'Masuk otomatis gagal, silakan masukkan kembali kredensial.'])->onlyInput('email');
    }
}

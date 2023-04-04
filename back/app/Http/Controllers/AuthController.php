<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['В доступе отказано']]);
        }

        return [
            'token' => $user->createToken($_SERVER['HTTP_USER_AGENT'])->plainTextToken,
            'user' => $user,
        ];
    }

    public function user()
    {
        // logger(request()->headers);
        return [
            'user' => auth()->user()
        ];
    }
}

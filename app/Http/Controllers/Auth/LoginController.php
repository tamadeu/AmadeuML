<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{

public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();
    } catch (\Exception $e) {
        return redirect('/login');
    }

    // Check if the user already exists
    $existingUser = User::where('email', $user->email)->first();

    if ($existingUser) {
        // Log in the existing user
        auth()->login($existingUser, true);
    } else {
        // Create a new user
        $newUser = new User;
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->save();
        
        auth()->login($newUser, true);
    }

    return redirect('/');
}

public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

}


<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Failed to authenticate with ' . $provider]);
        }

        // Check if user already exists
        $existingUser = User::where('email', $socialUser->getEmail())->first();

        if ($existingUser) {
            // Log in existing user
            Auth::login($existingUser, true);
        } else {
            // Create a new user
            $newUser = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'social_id' => $socialUser->getId(),
                'social_type' => $provider,
                'password' => bcrypt(str_random(16)) // Generate a random password
            ]);

            Auth::login($newUser, true);
        }

        return redirect()->intended(config('fortify.home'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Ensure the User model is imported
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function callback($provider)
    {
        // Obtain the user information from the provider
        $socialiteUser = Socialite::driver($provider)->user();
        
        // Adjusted to correctly query the user
        $user = User::where('provider_id', $provider . '|' . $socialiteUser->id)->first();

        if ($user) {
            // Update the existing user
            $user->update([
                'github_token' => $socialiteUser->token,
                'github_refresh_token' => $socialiteUser->refreshToken,
            ]);
        } else {
            // Create a new user
            $user = User::create([
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'provider_id' => $provider . '|' . $socialiteUser->id, // Save provider and ID together
                'github_token' => $socialiteUser->token,
                'github_refresh_token' => $socialiteUser->refreshToken,
            ]);
        }

        // Log in the user
        Auth::login($user);

        // Redirect to the dashboard or the intended page
        return redirect()->intended('/dashboard');
    }
}

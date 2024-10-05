<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    $githubUser = Socialite::driver($provider)->user();

    $user = User::updateOrCreate([
        'email' => $githubUser->email, // Use email to check for existing user
    ], [
        'provider_id' => $githubUser->id,
        'name' => $githubUser->name,
        'password' => '', // Leave password empty or set a default
        'provider_token' => $githubUser->token,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
}

}

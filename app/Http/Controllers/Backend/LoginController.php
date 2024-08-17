<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // dd($user);
        $exisitingUser = User::whereEmail($user->getEmail())->first();
        if($exisitingUser){
            Auth::login($exisitingUser);
        }else{
            $newUser = User::updateOrCreate([
                'role_id' => Role::where('role_slug', 'customer')->first()->id,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make('12345678'),
                'is_active' => true
            ]);

            Auth::login($newUser);
        }
        return redirect()->intended(route('dashboard', absolute: false));
    }
}

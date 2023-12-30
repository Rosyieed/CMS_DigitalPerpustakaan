<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                toast('Selamat Datang ' . Auth::user()->name . '<br>' . 'REN - Digital Perpustakaan', 'success');
                return redirect('/books');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('password'),
                ]);
                Auth::login($newUser);
                toast('Selamat Datang ' . Auth::user()->name . '<br>' . 'REN - Digital Perpustakaan', 'success');
                return redirect('/books');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

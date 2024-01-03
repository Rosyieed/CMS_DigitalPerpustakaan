<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        if (! Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors([
                'current_password' => __('Password yang anda masukkan salah.'),
            ])->withInput();
        }

        if ($request->current_password === $request->password) {
            return back()->withErrors([
                'password' => __('Password baru tidak boleh sama dengan password lama.'),
            ])->withInput();
        }

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors([
                'password' => __('Konfirmasi password tidak cocok'),
            ])->withInput();
        }

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        toast('Password Berhasil Diperbarui','success');
        return back();
    }
}

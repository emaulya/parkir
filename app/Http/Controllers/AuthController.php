<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
     ]);

   
    $user = User::query()
       ->where('username', $credentials['username'])
       ->where('status_aktif', 1)
       ->first();
      
        if ($user !== null && $this->passwordMatches($credentials['password'], $user->password)) {
            if (! str_starts_with($user->password, '$2y$')) {
                $user->forceFill([
                    'password' => Hash::make($credentials['password']),
                ])->save();
            }

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'petugas':
                    return redirect()->route('petugas.dashboard');
                case 'owner':
                    return redirect()->route('owner.dashboard');
                default:
                    Auth::logout();

                    return back()->with(
                        'error',
                        'Role pengguna tidak dikenali.'
                    );
            }
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput($request->only('email'));
    }

    private function passwordMatches(string $plainPassword, string $storedPassword): bool
    {
        if (str_starts_with($storedPassword, '$2y$')) {
            return Hash::check($plainPassword, $storedPassword);
        }

        return hash_equals($storedPassword, $plainPassword);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

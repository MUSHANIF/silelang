<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (auth()->user()->level == 3) {
            toastr()->success('Salam sehat!', 'Selamat datang admin!');
            return redirect()->intended(RouteServiceProvider::ADMIN)->with('Berhasil login','halo selamat datang!');;
        }elseif(auth()->user()->level == 2){
            toastr()->success('Salam sehat!', 'Selamat datang uSER!');
            return redirect()->intended(RouteServiceProvider::HOME)->with('Berhasil login','halo selamat datang!');;
        }
        toastr()->success('Selamat datang!', 'Halo');
        return redirect()->intended(RouteServiceProvider::HOME2)->with('Berhasil login','halo selamat datang!');
    }
}

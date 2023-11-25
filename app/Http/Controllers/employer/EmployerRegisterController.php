<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class EmployerRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        Redirect::setIntendedUrl(url()->route('employer.dashboard'));
        return view('employer.empregister');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'email:rfc,dns', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'type' => 'employer',
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        Auth::login($user);

        if ($user->type == 'student') {
            // Redirect to the home route for students

             // Alert logic
        if (!session()->has('alert_shown')) {
            session(['alert_shown' => true]);
            return redirect()->intended('dashboard');
        } else {
            return redirect()->intended('dashboard');
        }

        } else {

            if (!session()->has('alert_shown')) {
                session(['alert_shown' => true]);
                return redirect()->intended('employer.dashboard');
            } else {
                return redirect()->intended('employer.dashboard');
            }


            // Redirect to the employer route for other roles

        }
    }
}

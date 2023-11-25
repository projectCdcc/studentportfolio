<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        Redirect::setIntendedUrl(url()->route('dashboard'));
        Redirect::setIntendedUrl(url()->route('employer.dashboard'));
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user(); // Retrieve the authenticated user





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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
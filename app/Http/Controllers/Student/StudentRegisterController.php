<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class StudentRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {   

        Redirect::setIntendedUrl(url()->route('student.dashboard'));
        return view('student.student-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'type' => 'student',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userId = $user->id;

        $employer = Student::create([
            'username' => $request->username,
            'email' => $request->email,
            'user_id'=> $userId,
        ]);

        event(new Registered($user));

        Auth::login($user);

        
        if (!session()->has('alert_shown')) {
            session(['alert_shown' => true]);
            return redirect()->intended('student.dashboard');
        } else {
            return redirect()->intended('student.dashboard');
        }


        // Redirect to the employer route for other roles
    }
}

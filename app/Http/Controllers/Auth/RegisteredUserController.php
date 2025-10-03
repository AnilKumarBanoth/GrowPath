<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // Add validation rules for startup_name, bio, and phone
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'startup_name' => 'nullable|string|max:255', // Make this nullable since it's not required
            'bio' => 'nullable|string|max:500',          // Max length for bio can be specified
            'phone' => 'nullable|string|max:20',         // Max length for phone number
            'location' => 'nullable|string|max:255',
        ]);

        // Create user with the validated fields
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'startup_name' => $request->startup_name,  // This will store as null if not filled
            'bio' => $request->bio,                    // This will store as null if not filled
            'phone' => $request->phone,                // This will store as null if not filled
            'location' => $request->location,
        ]);

        // Fire Registered event
        event(new Registered($user));

        // Log the user in after registration
        Auth::login($user);

        // Redirect to dashboard
        return redirect(route('dashboard', absolute: false));
    }
}

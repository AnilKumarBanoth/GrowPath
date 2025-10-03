<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Update the user's profile with validated fields
        $request->user()->fill($request->validated());

        // Check if the email has been updated, and set email_verified_at to null if it has.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Save the updated user details to the database
        $request->user()->save();

        // Redirect back to the profile edit page with a success status
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the user password for deletion confirmation
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Log the user out and delete their account
        Auth::logout();

        // Delete the user from the database
        $user->delete();

        // Invalidate the session and regenerate the CSRF token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage after account deletion
        return Redirect::to('/');
    }
}

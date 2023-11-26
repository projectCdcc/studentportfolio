<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Employer;
use Illuminate\Support\Facades\File; 


class EmployerProfileController extends Controller
{
    /**
     * Display the employer's profile form.
     */

    public function edit(Request $request): View
    {
        return view('employer.empedit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('empProfile.edit')->with('status', 'profile-updated');
    }

    /**
     *  Update the user's profile picture
     * 
     */

    public function avatarUpdate(ProfileUpdateRequest $request): RedirectResponse {
        /**
         * Validated the array values of inputs. 
         * 
         */
        $request->user()->fill($request->validated());

        if($request->hasFile('avatar')){

            /**
             * define the name of file
             */
            $uniqueName = $request->file('avatar')->hashName();
            $avatarName = $uniqueName;

            /**
             * move the file to public/avatars folder
             */
            $request->avatar->move(public_path('avatars'), $avatarName);
            
             // Update the user's record in the database with the avatar file name or path
            $user = Auth::user();
            $employer = Employer::where('organization_name', $user->username)->first();
            
            // Check if the employer has an existing avatar
            if (!is_null($employer->avatar)) {
                // Delete the existing avatar file
                $existingAvatarPath = public_path('avatars') . '/' . $employer->avatar;
                if (File::exists($existingAvatarPath)) {
                    File::delete($existingAvatarPath);
                }

                // Check if the user is an employer and the organization_name matches the username
                if ($user->isEmployer()) {

                    // Update the 'avatar' column in the 'employers' table
                    $employer->update([
                        'avatar' => $avatarName, // Assuming $avatarName is defined in your code
                    ]);
                }
            }

            

            return Redirect::route('empProfile.edit')->with('upload', 'profile-updated');
        } else {
            return Redirect::route('empProfile.edit')->with('upload', 'Profile not updated!');
        }

        

    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}

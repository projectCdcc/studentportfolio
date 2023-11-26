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
use App\Models\User;
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

    public function avatarUpdate(ProfileUpdateRequest $request, $id): RedirectResponse {
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

          
             // Update the user's record in the database with the avatar file name or path
            $user = User::where('id', $id)->first();
           
            
            // Check if the employer has an existing avatar
            if (!is_null($user->avatar)) {

                // Delete the existing avatar file
                $existingAvatarPath = public_path('avatars') . '/' .$user->avatar;

                // dd($existingAvatarPath);
                if (File::exists($existingAvatarPath)) {
                    File::delete($existingAvatarPath);
                }


                  /**
                   * move the file to public/avatars folder
                   */
                $request->avatar->move(public_path('avatars'), $avatarName);
            
                // Check if the user is an employer and the organization_name matches the username
                if ($user->isEmployer()) {

                    // Update the 'avatar' column in the 'employers' table
                    $user->update([
                        'avatar' => $avatarName, // Assuming $avatarName is defined in your code
                    ]);
                }
            } else {

                  /**
                   * move the file to public/avatars folder
                   */
                    $request->avatar->move(public_path('avatars'), $avatarName);
            
              
                // Check if the user is an employer and the organization_name matches the username
                if ($user->isEmployer()) {

                    // Update the 'avatar' column in the 'employers' table
                    $user->update([
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
     * Update Organization Information 
     * 
     */

    public function orgUpdate(ProfileUpdateRequest $request): RedirectResponse {
         // Retrieve the authenticated user
         $user = $request->user();

         // Fill the user model with validated data
         $user->fill($request->validated());
 
         // Update employer-specific information
         $employer = Employer::where('organization_name', $user->username)->first();
 
         // Check if the employer exists
         if ($employer) {
             // Update employer-specific fields
             $employer->update([
                 'org_type' => $request->input('org_type'),
                 'street' => $request->input('street'),
                 'city' => $request->input('city'),
                 'country' => $request->input('country'),
                 'establish_year' => $request->input('establish_year'),
                 'about' => $request->input('about'),
                 
             ]);
         }
 
         // Redirect back to the profile edit page with a success message
         return redirect()->route('empProfile.edit')->with('update', 'Profile updated successfully.');
     
    }



    /**
     * Employer View details 
     * 
     */

    public function viewDetail(Request $request): view {

         // Retrieve the authenticated user
         $user = $request->user();

        // Update employer-specific information
        $employer = Employer::where('organization_name', $user->username)->first();

        return view('employer.emp-profile-detail', [
            'employer' => $employer,
        ]);
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

<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\EmployerRequest;
use App\Http\Requests\AvatarRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Employer;
use App\Models\User;
use App\Models\Student;
use App\Models\Job;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class EmployerProfileController extends Controller
{
    /**
     * Display the employer's profile form.
     */

    public function edit(Request $request): View
    {
        // retrieve employer info
        $user = $request->user();

        $employer = Employer::where('organization_name', $user->username)->first();

        return view('employer.empedit', [
            'user' => $request->user(), 'employer'=>$employer,
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

        // Retrieve the authenticated user
        $user = $request->user();

        // check if the user exist
        $check = User::where('id', $user->id)->first();

        // match the user == employer based on username == organization_name
        $employer = Employer::where('organization_name', $check->username)->first();

        $job = Job::where('company', $check->username)->get();

        // dd($employer->organization_name);

        if ($employer) {
            $employer->update([
                'organization_name' => $user->username,
                'email' => $request->email,
            ]);

             // Loop through each job and update the 'company' column
            foreach ($job as $data) {
                $data->update([
                    'company' => $user->username,
                ]);
            }

            $userUpdated = $request->user()->save();

        }


        return Redirect::route('empProfile.edit')->with('status', 'profile-updated');
    }

    /**
     *  Update the user's profile picture
     *
     */

    public function avatarUpdate(AvatarRequest $request, $id): RedirectResponse {
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

    public function orgUpdate(EmployerRequest $request): RedirectResponse {
        // Retrieve the authenticated user
        $user = $request->user();


        // Use the relationship to get the associated employer
        $employer = $user->employer;

        // Check if the employer exists
        if ($employer) {
            // Update employer-specific fields
            $employer->update([
                'org_type' => $request->input('org_type'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'establish_year' => $request->input('establish_year'),
                'phone' => $request->input('phone'),
                'website' => $request->input('website'),
                'about' => $request->input('about'),
            ]);
        }

         // Redirect back to the profile edit page with a success message
         return redirect()->route('empProfile.edit')->with('update', 'Profile updated successfully.');

    }

    /**
     * 
     * employer view student details 
     */

     public function viewStudent($id) {
        $student = Student::where('id', $id)->first();
        return view('student.student-profile-detail')->with('student', $student);
    }
 



    /**
     * Employer View details
     *
     */

    public function viewDetail(Request $request): view {

         // Retrieve the authenticated user
        $user = $request->user();

        // employer-specific information
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
        $avatarFilename = $user->avatar;

        // dd($avatarFilename);
        // If avatar filename is present, construct the full path and delete the file
        if ($avatarFilename) {
            $existingAvatarPath = public_path('avatars') . '/' .$avatarFilename;

            // Delete the avatar file if it exists
            if (File::exists($existingAvatarPath)) {
                File::delete($existingAvatarPath);
            }
        }

        // Check all the jobs that is pased by the authorized user.
        $job = Job::where('company', $user->username)->get();

        // Delete jobs
        foreach ($job as $data) {
            $data->delete();
        }


        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}

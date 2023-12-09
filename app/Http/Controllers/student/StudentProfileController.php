<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\Student;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StudentProfileUpdateRequest;
use App\Http\Requests\AvatarRequest;
use App\Models\Employer;
use App\Models\User;
use App\Models\Cv;
use App\Models\Job;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{

    /**
     * Display the student's profile form.
     */

     public function edit(Request $request): View
     {
         // retrieve authenticated student info
         $user = $request->user();

         $student = Student::where('user_id', $user->id)->first();

         return view('student.student-edit', [
             'user' => $request->user(), 'student'=>$student,
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

        // match the user == employer based on userid
        $student = Student::where('user_id', $check->id)->first();



        // dd($student->username);

        if ($student) {
            $student->update([
                'username' => $user->username,
                'email' => $request->email,
            ]);

            //  // Loop through each job and update the 'company' column
            // foreach ($job as $data) {
            //     $data->update([
            //         'company' => $user->username,
            //     ]);
            // }

            $userUpdated = $request->user()->save();

        }


        return Redirect::route('student.profile.edit')->with('status', 'profile-updated');
    }


    /**
     *
     * Update student profile pictures
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
                if ($user->isStudent()) {

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
                if ($user->isStudent()) {

                    // Update the 'avatar' column in the 'employers' table
                    $user->update([
                        'avatar' => $avatarName, // Assuming $avatarName is defined in your code
                    ]);
                }
            }
            return Redirect::route('student.profile.edit')->with('upload', 'profile-updated');
        } else {
            return Redirect::route('student.profile.edit')->with('upload', 'Profile not updated!');
        }
    }


    /**
     * Update student details.
     *
     */

    public function detailUpdate(StudentProfileUpdateRequest $request): RedirectResponse {
        // Retrieve the authenticated user
        $user = $request->user();


        // Use the relationship to get the associated employer
        $student = $user->student;

        // Check if the employer exists
        if ($student) {
            // Update employer-specific fields
            $student->update([
                'graduate_date' => $request->input('graduate_date'),
                'about_me' => $request->input('about_me'),
            ]);
        }

         // Redirect back to the profile edit page with a success message
         return redirect()->route('student.profile.edit')->with('update', 'profile-updated');

    }


    /**
     * Student View details
     *
     */

     public function viewDetail(Request $request): view {

        // Retrieve the authenticated user
       $user = $request->user();

       // student-specific information
       $student = Student::where('user_id', $user->id)->first();

       $cv = Cv::where('student_id', $student->id)->first();

       return view('student.student-profile-detail', [
           'student' => $student,
           'cv' =>$cv,
       ]);
   }

   /**
     *
     * Student view employer details
     */

     public function viewEmployer($id) {
        $job = Job::where('id', $id)->first();

        $employer = Employer::where('organization_name', $job->company)->first();

        $user = User::where('id', $employer->user_id)->first();

        return view('student.student-view-employer', [
           'employer' => $employer,
           'user' =>$user,
        ]);
    }


    /**
     * Delete the user's account (Student)
     */
    public function destroy(Request $request): RedirectResponse
    {   
        // validate if the userDElection is confirmed by the password. 
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        $avatarFilename = $user->avatar;


        if ($avatarFilename) {
            $existingAvatarPath = public_path('avatars') . '/' .$avatarFilename;

            // Delete the avatar file if it exists
            if (File::exists($existingAvatarPath)) {
                File::delete($existingAvatarPath);
            }
        }

        $student = Student::where('user_id', $user->id)->first();

        $cv = Cv::where('student_id', $student->id)->first();

        $cvFilename = $cv->attachment;

        // Delte the cv upload by the user. 

        if ($cvFilename) {
            $existingCvPath = public_path('cv') . '/' .$cvFilename;

            // Delete the avatar file if it exists
            if (File::exists($existingCvPath)) {
                File::delete($existingCvPath);
            }
        }

        Auth::guard('web')->logout();

        $user->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

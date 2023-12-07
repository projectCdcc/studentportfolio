<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Http\Requests\CvRequest;
use App\Models\Student;
use Illuminate\Http\Request;


class StudentCvController extends Controller
{
    // returning view
    public function create(Request $request)  {
         // retrieve authenticated student info
        $user = $request->user();

        $student = Student::where('user_id', $user->id)->first();

        $cv = Cv::where('student_id', $student->id)->first();
        return view('student.cv.student-cv')->with('cv', $cv);
    }


    public function upload(CvRequest $request, $id) {

        // Get the student ID
        $studentId = Student::where('user_id', $id)->first();

        // Check if there is a CV record for the student
        $cv = Cv::where('student_id', $studentId->id)->first();

        if ($cv) {
            // File exists, delete the old record and replace with a new one
            if (\File::exists(public_path('cv/') . $cv->attachment)) {
                \File::delete(public_path('cv/') . $cv->attachment);
            }

            // Delete the old record from the "cv" table
            $cv->delete();
        } else {
            // No record found, create a new one
            $cv = new Cv();
        }

        if ($request->hasFile('cv')) {
            $cvName = time() . '.' . $request->cv->getClientOriginalExtension();
            $request->cv->move(public_path('cv'), $cvName);

            // Create a new record in the "cv" table with the updated file
            $cv->student_id = $studentId->id;
            $cv->attachment =$cvName;
            $cv->save();

            return redirect(route('student.cv.view'))->with("cv", "Profile Updated");
        } else {

            return redirect(route('student.cv.view'))->with('cv', "PDF can't uploaded");
        }

    }

}

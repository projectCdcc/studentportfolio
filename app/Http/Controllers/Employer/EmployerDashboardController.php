<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class EmployerDashboardController extends Controller
{
    //index
    public function index() {
        $students = Student::with('user')->orderBy('created_at', 'desc')->paginate(4);
        // Assuming you want to get the avatar of the first user associated with the first student.
        return view('employer.empdashboard')->with('students', $students);
    }

    public function search(Request $request) {
        if ($request->ajax()) {
            $search = $request->input('search', '');

            // Validate the input to ensure it's a string and not too long
            $validated = $request->validate([
                'search' => 'nullable|string|max:255',
            ]);

            // Initialize the query
            $query = Student::query();

            // Check for an exact match first
            $exactMatch = $query->where('username', $search)
                                ->orWhere('email', $search)
                                ->orWhere('major', $search)
                                ->first();

            if ($exactMatch) {
                // If there is an exact match, return only that match
                $students = collect([$exactMatch]);
            } else {
                // If no exact match, perform the partial match search
                $students = Student::where(function ($query) use ($search) {
                    $query->where('username', 'LIKE', "%$search%")
                          ->orWhere('email', 'LIKE', "%$search%")
                          ->orWhere('major', 'LIKE', "%$search%");
                })->get();
            }

            $output = '';
            foreach ($students as $student) {
                $id = e($student->id); // Use e() for HTML escaping
                $username = e($student->username);
                $email = e($student->email);
                $major = e($student->major);
                $studentLink = route('employer.view.student', ['id' => $id]);

                // Using Heredoc syntax for clearer HTML structure
                $output .= <<<HTML
                <tr class="border-b border-gray-200 bg-white">
                    <td class="px-5 py-5 text-sm">
                    <p class="whitespace-no-wrap">$id</p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <div class="ml-3">
                        <a href="$studentLink" class="text-blue-800 hover:underline">
                        <p class="whitespace-no-wrap">$username</p>
                        </a>
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        <p class="whitespace-no-wrap">$email</p>
                    </td>
                    <td class="px-5 py-5 text-sm">
                    <p class="whitespace-no-wrap">$major</p>
                    </td>
                </tr>
                HTML;
            }

            return response($output); // Send the response back to the AJAX call
        }
    }





}

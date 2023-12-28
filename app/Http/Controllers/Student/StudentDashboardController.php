<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class StudentDashboardController extends Controller
{
     //index
     public function index() {
        $jobs = Job::orderBy('created_at', 'desc')->paginate(6);
        return view('student.student-dashboard')->with('jobs', $jobs);
    }

    public function search(Request $request) {
        if ($request->ajax()) {
            $search = $request->input('find', '');

            // Validate the input
            $validated = $request->validate([
                'find' => 'nullable|string|max:255',
            ]);

            // Initialize the query for Job model
            $query = Job::query();

            // Check for an exact match in different fields
            $exactMatch = $query->where('title', $search)
                                ->orWhere('city', $search)
                                ->orWhere('country', $search)
                                ->orWhere('job_type', $search)
                                ->orWhere('category', $search)
                                ->first();

            if ($exactMatch) {
                // If there is an exact match, return only that match
                $jobs = collect([$exactMatch]);
            } else {
                // If no exact match, perform a partial match search
                $jobs = Job::where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%$search%")
                          ->orWhere('city', 'LIKE', "%$search%")
                          ->orWhere('country', 'LIKE', "%$search%")
                          ->orWhere('job_type', 'LIKE', "%$search%")
                          ->orWhere('category', 'LIKE', "%$search%");
                })->get();
            }

            $output = '';
            foreach ($jobs as $job) {
                // Use e() for HTML escaping
                $id = e($job->id);
                $title = e($job->title);
                $city = e($job->city);
                $country = e($job->country);
                $jobType = e($job->job_type);
                $category = e($job->category);
                $jobLink = route('employer.job.detail', ['id' => $id]);

                // Construct the HTML output
                $output .= <<<HTML
                <div class="bg-white my-4 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md">
                    <div>
                        <span class="text-purple-800 text-sm">$category</span>
                        <h3 class="font-bold mt-px">$title</h3>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">$jobType</span>
                            <span class="text-slate-600 text-sm flex gap-1 items-center">$city , $country</span>
                        </div>
                    </div>
                    <div>
                        <a href="$jobLink">
                            <button class="bg-purple-900 text-white font-medium px-4 py-2 rounded-md flex gap-1 items-center">View Detail</button>
                        </a>
                    </div>
                </div>
                HTML;
            }

            return response($output); // Send the response back to the AJAX call
        }
    }


}

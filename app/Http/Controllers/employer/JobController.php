<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Employer;
use App\Models\User;

class JobController extends Controller
{
      // lists of Jobs
      public function jobList()
      {
          // Retrieve all jobs from the jobs table as a collection
          $jobs = Job::orderBy('created_at', 'desc')->paginate(5);


          // Return the collection of jobs
          return view('employer.jobs.emp-job-list')->with('jobs', $jobs);
      }

      // details of Jobs
      public function jobDetail($id)
      {
        // Retrive all jobs from the jobs table as a collection
        $job = Job::where('id', $id)->first();

        $userAvatar = User::where('username', $job->company)->first();
        // dd($userAvatar->avatar);
        $company = Employer::where('organization_name', $job->company)->first();

        return view('employer.jobs.emp-job-detail')->with(['job' => $job, 'company' => $company, 'userAvatar'=>$userAvatar]);
      }

}

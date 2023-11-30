<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Employer;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class EmployerJobController extends Controller
{
    //index method (userid)
    public function index($id) {

        $user = User::where('id', $id)->first();

        $employer = Employer::where('organization_name', $user->username)->first();

        $jobs = Job::where('company', $employer->organization_name)->paginate(10);


        return view('employer.jobs.emp-job')->with('jobs', $jobs);
    }


    //create job
    public function store(JobRequest $request, $id)
    {
        $request->validated();
        $user = User::where('id', $id)->first();
        $employer = Employer::where('organization_name', $user->username)->first();

        $job = Job::create([
            'title'=>$request->title,
            'city'=>$request->city,
            'country'=>$request->country,
            'job_type'=>$request->type,
            'category' => $request->category,
            'description'=>$request->description,
            'requirement'=>$request->requirement,
            'how_to'=>$request->apply,
            'company'=>$employer->organization_name,
        ]);

        if(!$job) {
            return Redirect::route('empJob.show', $user->id)->with('error', 'profile-is-not-updated');
        } else {
            return Redirect::route('empJob.show', $user->id)->with('success', 'profile-updated');
        }
    }

    // lists of Jobs
    public function jobList()
        {
            // Retrieve all jobs from the jobs table as a collection
            $jobs = Job::all();

            // Return the collection of jobs
            return view('employer.jobs.emp-job-list')->with('jobs', $jobs);
        }


    //update job
    public function update(JobRequest $request, $id) {
        $request->validated();
        $job = Job::where('id', $id)->first();
        $user = Auth::user()->id;

        $job->update([
            'title'=>$request->title,
            'city'=>$request->city,
            'country'=>$request->country,
            'job_type'=>$request->type,
            'category' => $request->category,
            'description'=>$request->description,
            'requirement'=>$request->requirement,
            'how_to'=>$request->apply,
        ]);

        if(!$job) {
            return Redirect::route('empJob.show', $user)->with('error', 'job-is-not-updated');
        } else {
            return Redirect::route('empJob.show', $user)->with('success', 'job-updated');
        }
    }


    //delete job
    public function destroy($userId, $jobId)
    {
        // Find user
            $user = User::findOrFail($userId);

        // Assuming the organization_name is the same as username
            $employer = $user->username;

        // Find the job based on the job ID and company (organization_name)
            $job = Job::where('id', $jobId)->where('company', $employer)->first();

        // Delete the job
            $job->delete();

        return Redirect::route('empJob.show', $user->id)->with('success', 'Job deleted successfully');
    }


}

<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{
    //index method
    public function index() {
        return view('employer.jobs.emp-job');
    }

    
    public function store(Request $request, $id) {
        $request->validate([
            'title' =>'required',
            'city'=>'required',
            'country'=>'required',
            'type'=> 'required',
            'category'=> 'required',
            'description' => 'required',
            'requirement' => 'required',
            'company' => 'required',
            'apply'=>'required',
        ]);

        $user = User::where('id', $id)->first();    

        $employer = Employer::where('organization_name', $user->username)->first();

        $username = $user->username;

        $data['title']= $request->title;
        $data['city']=$request->city;
        $data['country']=$request->country;
        $data['job_type']=$request->type;
        $data['category']=$request->category;
        $data['description']=$request->description;
        $data['requirement']=$request->requirement;
        $data['how_to']=$request->apply;
        $data['company']= $employer()->organization;
        $job = Job::create($data);

        if(!$job) {
            return Redirect::route('empJob.show')->with('error', 'profile-is-not-updated');
        }

        return Redirect::route('empJob.show')->with('success', 'profile-updated');
      
    }


}

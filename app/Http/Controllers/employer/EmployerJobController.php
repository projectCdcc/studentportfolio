<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{
    //index


    public function index() {
        return view('employer.jobs.emp-job');
    }
}

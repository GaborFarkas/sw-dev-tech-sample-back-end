<?php

namespace App\Http\Controllers;

use App\Models\DataResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ErrorResponse;
use App\Models\Job;
use App\Models\SuccessResponse;
use App\Models\UserResponse;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function post_job(Request $request)
    {
        $roles = Auth::payload()['roles'];
        if (!(in_array(2, $roles) || in_array(3, $roles))) {
            return response()->json(new ErrorResponse('You don\'t have permission to post a job'), 401);
        }

        $request->validate([
            'expiry' => 'required|date',
            'title' => 'required|string',
            'description' => 'required|string',
            'prompt' => 'required|string'
        ]);

        Job::create([
            'title' => $request->title,
            'expiry' => $request->expiry,
            'description' => $request->description,
            'prompt' => $request->prompt,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(new SuccessResponse());
    }

    public function get_jobs()
    {
        return response()->json(new DataResponse(Job::all()->makeHidden('description')));
    }

    public function get_job(Request $request, int $id)
    {
        $job = Job::where('id', $id)->first()->makeHidden('id');
        if (!$job) {
            return response()->json(new ErrorResponse('Could not found job'), 404);
        }

        return response()->json(new DataResponse($job));
    }
}

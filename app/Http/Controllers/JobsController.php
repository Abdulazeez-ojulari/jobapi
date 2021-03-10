<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\Job;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $jobs = Job::all();

        if($jobs){
            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'code' => 200,
                'data' => $jobs,
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.. Please try again',
                'code' => 500,
                'data' => [],
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }
    }

    public function getByJobId(Request $request, $jobId)
    {
        $job = DB::table('jobs')
                ->where('id', $jobId)->get();

        if($job){
            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'code' => 200,
                'data' => $job,
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Job with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }
    }

    public function getByUserId(Request $request, $userId)
    {
        $job = DB::table('jobs')
                ->where('user_id', $userId)->get();
                
        if($job){
            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'code' => 200,
                'data' => $job,
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Job with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, $userId){
        $user = User::find($userId);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);
            
        }

        $this->validate($request, [
            'job_title' => 'required|max:50',
            'company_name' => 'required|max:50',
            'location' => 'required|max:255',
            'job_types' => 'required|max:50',
            'salary_range' => 'required|max:50',
            'submission_deadline' => 'required|max:50',
            'job_sector' => 'required|max:20'
        ]);

        // $request->users()->jobs()->create($request->only('job_title', 'company_name', 'location', 'job_types', 'salary_range', 'submission_deadline', 'job_sector'));

        $job = new Job;

        $job->user_id = $userId;
        $job->job_title = $request->input('job_title');
        $job->company_name = $request->input('company_name');
        $job->location = $request->input('location');
        $job->job_types = $request->input('job_types');
        $job->salary_range = $request->input('salary_range');
        $job->submission_deadline = $request->input('submission_deadline');
        $job->job_sector = $request->input('job_sector');

        $job->save();

        return response()->json([
            'status' => 'success',
            'message' => 'successful',
            'code' => 200,
            'data' => $job,
        ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jobId)
    {
        $job = Job::find($jobId);

        if(!$job){
            return response()->json([
                'status' => 'error',
                'message' => 'Job with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }

        $this->validate($request, [
            'job_title' => 'required|max:50',
            'company_name' => 'required|max:50',
            'location' => 'required|max:255',
            'job_types' => 'required|max:50',
            'salary_range' => 'required|max:50',
            'submission_deadline' => 'required|max:50',
            'job_sector' => 'required|max:20'
        ]);

        $job->update($request->all()); 
        
        $job = Job::find($jobId);

        return response()->json([
            'status' => 'success',
            'message' => 'successful',
            'code' => 200,
            'data' => $job,
        ])->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($jobId)
    {
        $job = Job::find($jobId);

        if(!$job){
            return response()->json([
                'status' => 'error',
                'message' => 'Job with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }

        $job->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'successful',
            'code' => 200,
            'data' => $job,
        ])->withHeaders([
            'Content-Type' => 'application/json',
        ]);

    }
}

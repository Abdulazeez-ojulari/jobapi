<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;

class JobApplicationController extends Controller
{

    public function getById(Request $request, $jobApplicationId)
    {
        $jobapplication = DB::table('job_applications')
                ->where('id', $jobApplicationId)->get();

        
         if($jobapplication){
            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'code' => 200,
                'data' => $jobapplication,
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Job application with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }
    }

    public function getByJobId(Request $request, $jobId)
    {
        $jobapplication = DB::table('job_applications')
                ->where('job_id', $jobId)->get();

        
         if($jobapplication){
            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'code' => 200,
                'data' => $jobapplication,
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Job application with the given job id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }
    }


    public function create(Request $request)
    {
         $this->validate($request, [
            'job_id' => 'required',
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'location' => 'required|min:3|max:50',
            'email_address' => 'required|min:5|max:255',
            'phone_no' => 'required|min:10',
            // 'cv' => 'required|max:2028'
        ]);

        try {
            $namewithext = $request->file('cv')->getClientOriginalName();

            $realPath = $request->file('cv')->getRealPath();

            $mimeType = $request->file('cv')->getMimeType();
        
            $name = pathinfo($namewithext, PATHINFO_FILENAME);

            $extension = $request->file('cv')->getClientOriginalExtension();

            $filetostore = $name.'_'.time().'.'.$extension;

            $path = $request->file('cv')->storeAs('public/cv', $filetostore);

            $cvs = $request->file('cv');

            $jobapplication = new JobApplication;
            $jobapplication->job_id = $request->input('job_id');
            $jobapplication->first_name = $request->input('first_name');
            $jobapplication->last_name = $request->input('last_name');
            $jobapplication->location = $request->input('location');
            $jobapplication->email_address = $request->input('email_address');
            $jobapplication->phone_no = $request->input('phone_no');
            $jobapplication->cv = $filetostore;
            $jobapplication->save();

            if($jobapplication){
                return response()->json([
                    'status' => 'success',
                    'message' => 'successful',
                    'code' => 200,
                    'data' => $jobapplication,
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

        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not sumbit your application',
                'code' => 500,
                'data' => [],
                ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
        }

    }
    
}

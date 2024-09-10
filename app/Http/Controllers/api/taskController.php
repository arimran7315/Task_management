<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Mail\upateEmail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class taskController extends ResponseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return $this->SuccessResponse($tasks,'All tasks');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
        ]);
        if($task->fails()){
            return $this->ErrorResponse('Validation Error', $task->errors()->all(),401);
        }
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 0
        ]);
        return $this->SuccessResponse($task, 'Task Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::select('id','title','description','status')
        ->where('id', $id)->get();
        return $this->SuccessResponse($task, 'Single Task');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Validator::make(
            $request->all(),
            [
                'title' =>'required',
                'description' =>'required',
                'status' =>'required',
            ]
        );
        if($task->fails()){
            return $this->ErrorResponse('Validation Error', $task->errors()->all(),401);
        }
        $task = Task::where('id', $id)
        ->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        $mailData ='';
        $mailData = [
            'subject'=>'Meeting Status Updated',
            'title' => $request->title,
        ];
        Mail::to($request->email)->send(new upateEmail($mailData));
        return $this->SuccessResponse($task,'task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->delete();
        return $this->SuccessResponse($task,'task Deleted Successfully');
    }
}

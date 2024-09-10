<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends ResponseController
{
    public function search(Request $request){
        $data = Validator::make($request->all(),[
            'search'=> 'required'
        ]);
        if($data->fails()){
            return $this->ErrorResponse('Validation Error', $data->errors()->all(),401);
        }
        $data = Task::where('title', 'like', '%' . $request->search . '%')->get();
        return $this->SuccessResponse($data, 'Successfully');
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\ServiceTask;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;


class ServiceTaskController extends Controller {

    public function index()
    {
        $ServiceTask = ServiceTask::orderBy('service_task_id', 'ASC')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('ServiceTask')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',                
            'description' => 'required',                
            'subtask' => 'required'              
        ];
        return $rules;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $ServiceTask = new ServiceTask;
        $ServiceTask->name =$request->name;
        $ServiceTask->description =$request->description;
        $ServiceTask->subtask =$request->subtask;
        $ServiceTask->save();
        return Response()->json(['status'=>true,'message'=>'Service Task created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $ServiceTask = ServiceTask::where('service_task_id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('ServiceTask')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $ServiceTask = ServiceTask::where('service_task_id',$id)->first();
        $ServiceTask->name =$request->name;
        $ServiceTask->description =$request->description;
        $ServiceTask->subtask =$request->subtask;
        $ServiceTask->save();
        return Response()->json(['status'=>true,'message'=>'Service Task updated', 'response'=>[]], 200);
    }
    public function fileuploadExtra($request, $key){
        $file = $request->file($key);
        $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
        $filename = time().'_'.$file->getClientOriginalName();
        $upload_success = $file->move($destinationPath, $filename);
        $uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;            
        return $uploaded_file;
    }
    public function destroy(Request $request, $id)
    {
        $ServiceTask = ServiceTask::where('service_task_id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Service Task Deleted', 'response'=>[]], 200);
    }


}


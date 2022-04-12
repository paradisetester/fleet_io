<?php

namespace App\Http\Controllers\Api\V1\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Service;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;


class ServiceHistoryController extends Controller {

    public function index()
    {
        $service = Service::with('vehicleName')->orderBy('service_id', 'ASC')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('service')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'vehicle_id' => 'required',        
            'user_id' => 'required',         
            'odometer' => 'required',        
            'completion_date' => 'required',        
            'completion_time' => 'required',        
            'vendor_id' => 'required',        
            'reference' => 'required',        
            'labels' => 'required',               
            'comment' => 'required',        
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
        $service = new Service;
        $service->vehicle_id =$request->vehicle_id;
        $service->user_id =$request->user_id;
        $service->odometer =$request->odometer;
        $service->completion_date=date('Y-m-d', strtotime($request->completion_date));
        $service->completion_time =$request->completion_time;
        $service->vendor_id =$request->vendor_id;
        $service->reference =$request->reference;
        $service->labels =$request->labels;
        if ($request->pageFile) {
        $service->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        if ($request->pageDocFile) {
        $service->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        $service->comment =$request->comment;
        $service->save();
        return Response()->json(['status'=>true,'message'=>'Service History created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $service = Service::where('service_id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('service')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $service = Service::where('service_id',$id)->first();
        $service->vehicle_id =$request->vehicle_id;
        $service->user_id =$request->user_id;
        $service->odometer =$request->odometer;
        $service->completion_date=date('Y-m-d', strtotime($request->completion_date));
        $service->completion_time =$request->completion_time;
        $service->vendor_id =$request->vendor_id;
        $service->reference =$request->reference;
        $service->labels =$request->labels;
        if ($request->pageFile) {
        $service->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        else
        {
            $service->photo = Null;
        }
        if ($request->pageDocFile) {
        $service->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        else
        {
            $service->document = Null;
        }
        $service->comment =$request->comment;
        $service->save();
        return Response()->json(['status'=>true,'message'=>'Service History updated', 'response'=>[]], 200);
    }
    public function fileuploadExtra($request, $key){
        $file = $request->file($key);
		 $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
       // $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
        $filename = time().'_'.$file->getClientOriginalName();
        $upload_success = $file->move($destinationPath, $filename);
        $uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;            
        return $uploaded_file;
    }
    public function destroy(Request $request, $id)
    {
        $service = Service::where('service_id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Service History Deleted', 'response'=>[]], 200);
    }


}


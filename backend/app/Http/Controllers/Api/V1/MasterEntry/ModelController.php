<?php

namespace App\Http\Controllers\Api\V1\MasterEntry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleModel;
use App\Models\V1\VehicleMake;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;


class ModelController extends Controller {

    public function index()
    {
        $vehiclemodel = VehicleModel::with('vehiclemake')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehiclemodel')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',
            'make_id' => 'required',        
            'description' => 'required',       
            'status' => 'required',        
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
        $vehiclemodel = new VehicleModel;
        $vehiclemodel->name =$request->name;
        $vehiclemodel->make_id =$request->make_id;
        $vehiclemodel->description =$request->description;
        $vehiclemodel->status =$request->status;
        $vehiclemodel->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Model created', 'response'=>[]], 200);
    }

    public function vehicleModelByMake($id)
    {
        $vehiclemodel = VehicleModel::where('make_id',$id)->get();
       
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehiclemodel')], 200);
    }

    public function edit($id)
    {
        $vehiclemodel = VehicleModel::where('id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehiclemodel')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vehiclemodel = VehicleModel::where('id',$id)->first();
        $vehiclemodel->name =$request->name;
        $vehiclemodel->make_id =$request->make_id;
        $vehiclemodel->description =$request->description;
        $vehiclemodel->status =$request->status;
        $vehiclemodel->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Model updated', 'response'=>[]], 200);
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
        $vehiclemodel = VehicleModel::where('id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Vehicle Model Deleted', 'response'=>[]], 200);
    }

    public function verifyModel(Request $request)
    {
        $model = $request->input('name');
        $vehiclemodel = VehicleModel::where('name', $model)->count();
        if($vehiclemodel > 0)
        {
        return Response()->json(['status' => true, 'message' => 'Sorry! Vehcile Model is Already exist.', 'response'=>compact('vehiclemodel')], 200);    
        }
        else{
         return Response()->json(['status' => true, 'message' => '', 'response'=>compact('vehiclemodel')], 200); 
        }
        
    }


}


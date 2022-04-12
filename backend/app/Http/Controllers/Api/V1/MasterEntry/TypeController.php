<?php

namespace App\Http\Controllers\Api\V1\MasterEntry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Vehicletype;
use App\Models\V1\VehicleModel;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;


class TypeController extends Controller {

    public function index()
    {
        $vehicletype = Vehicletype::with('VehicleType_Relation_With_model')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicletype')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',
            'model_id' => 'required',        
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
        $vehicletype = new Vehicletype;
        $vehicletype->name =$request->name;
        $vehicletype->model_id  =$request->model_id;
        $vehicletype->description =$request->description;
        $vehicletype->status =$request->status;
        $vehicletype->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Type created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $vehicletype = Vehicletype::where('id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicletype')], 200);
    }

    public function vehicleTypeByModel($id)
    {
        $vehicletype = Vehicletype::where('model_id',$id)->get();
       
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicletype')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vehicletype = Vehicletype::where('id',$id)->first();
        $vehicletype->name =$request->name;
        $vehicletype->model_id  =$request->model_id;
        $vehicletype->description =$request->description;
        $vehicletype->status =$request->status;
        $vehicletype->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Type updated', 'response'=>[]], 200);
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
        $vehicletype = Vehicletype::where('id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Vehicle Type Deleted', 'response'=>[]], 200);
    }

    public function verifyType(Request $request)
    {
        $type = $request->input('name');
        $vehicletype = Vehicletype::where('name', $type)->count();
        if($vehicletype > 0)
        {
        return Response()->json(['status' => true, 'message' => 'Sorry! Vehcile Type is Already exist.', 'response'=>compact('vehicletype')], 200);    
        }
        else{
         return Response()->json(['status' => true, 'message' => '', 'response'=>compact('vehicletype')], 200); 
        }
        
    }


}


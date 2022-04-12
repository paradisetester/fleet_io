<?php

namespace App\Http\Controllers\Api\V1\MasterEntry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleMake;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;


class MakeController extends Controller {

    public function index()
    {
        $vehiclemake = VehicleMake::all();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehiclemake')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',       
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
        $vehiclemake = new VehicleMake;
        $vehiclemake->name =$request->name;
        $vehiclemake->description =$request->description;
        $vehiclemake->status =$request->status;
        $vehiclemake->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Make created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $vehiclemake = VehicleMake::where('id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehiclemake')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vehiclemake = VehicleMake::where('id',$id)->first();
        $vehiclemake->name =$request->name;
        $vehiclemake->description =$request->description;
        $vehiclemake->status =$request->status;
        $vehiclemake->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Make updated', 'response'=>[]], 200);
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
        $vehiclemake = VehicleMake::where('id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Vehicle Make Deleted', 'response'=>[]], 200);
    }

    public function verifyMake(Request $request)
    {
        $make = $request->input('name');
        $vehiclemake = VehicleMake::where('name', $make)->count();
        if($vehiclemake > 0)
        {
        return Response()->json(['status' => true, 'message' => 'Sorry! Vehcile Make is Already exist.', 'response'=>compact('vehiclemake')], 200);    
        }
        else{
         return Response()->json(['status' => true, 'message' => '', 'response'=>compact('vehiclemake')], 200); 
        }
        
    }


}


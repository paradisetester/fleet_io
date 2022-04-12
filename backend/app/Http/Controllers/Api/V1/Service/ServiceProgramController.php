<?php

namespace App\Http\Controllers\Api\V1\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\ServiceProgram;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};


class ServiceProgramController extends Controller {
    use HelperTrait, UserTrait;
    public function index()
    {
        $serviceprogram = ServiceProgram::orderBy('service_program_id', 'ASC')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('serviceprogram')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',                
            'template' => 'required',                
            'primary_meter' => 'required'              
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
        $serviceprogram = new ServiceProgram;
        $serviceprogram->name =$request->name;
        $serviceprogram->template =$request->template;
        $serviceprogram->primary_meter =$request->primary_meter;
        $serviceprogram->secondary_meter =$request->secondary_meter;
        if ($request->pageFile) {
        $serviceprogram->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        $serviceprogram->save();
        return Response()->json(['status'=>true,'message'=>'Service Program created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $serviceprogram = ServiceProgram::where('service_program_id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('serviceprogram')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $serviceprogram = ServiceProgram::where('service_program_id',$id)->first();
        $serviceprogram->name =$request->name;
        $serviceprogram->template =$request->template;
        $serviceprogram->primary_meter =$request->primary_meter;
        $serviceprogram->secondary_meter =$request->secondary_meter;
        if ($request->pageFile) {
        $serviceprogram->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        else
        {
            $serviceprogram->photo = Null;
        }
        $serviceprogram->save();
        return Response()->json(['status'=>true,'message'=>'Service Program updated', 'response'=>[]], 200);
    }
    public function destroy(Request $request, $id)
    {
        $serviceprogram = ServiceProgram::where('service_program_id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Service Program Deleted', 'response'=>[]], 200);
    }


}


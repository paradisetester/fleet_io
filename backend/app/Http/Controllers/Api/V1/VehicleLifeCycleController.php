<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleDetails;
use App\Models\V1\VehicleLifCycle;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;

class VehicleLifeCycleController extends Controller {

    public function index(Request $request)
    {
        $vehicleLifecycle = VehicleLifCycle::where('vehicle_id', $request->input('vehicle_id'))->get()->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleLifecycle')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'vehicle_id' => 'required|numeric',
            'service_date' => 'required',
            'odometer' => 'required',
            'service_life_in_month' => 'required',
            'service_life_in_miles' => 'required',
            'resale_value' => 'required',
            'out_of_service_date' => 'required',
            'out_of_service_odometer' => 'required'
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
        $message = 'Vehicle Life Cycle created';
        if (!$vehicleLifecycle = VehicleLifCycle::where('vehicle_id', $request->input('vehicle_id'))->get()->first()) {
            $vehicleLifecycle = new VehicleLifCycle;    
            $vehicleLifecycle->vehicle_id =$request->vehicle_id;
            $message = 'Vehicle Life Cycle updated';
        }                
        $vehicleLifecycle->service_date=date('Y-m-d', strtotime($request->service_date));
        $vehicleLifecycle->odometer =$request->odometer;
        $vehicleLifecycle->service_life_in_month =$request->service_life_in_month;
        $vehicleLifecycle->service_life_in_miles =$request->service_life_in_miles;
        $vehicleLifecycle->resale_value =$request->resale_value;
        $vehicleLifecycle->out_of_service_date=date('Y-m-d', strtotime($request->out_of_service_date));
        $vehicleLifecycle->out_of_service_odometer =$request->out_of_service_odometer;
        $vehicleLifecycle->save();

        return Response()->json(['status'=>true,'message'=>$message, 'response'=>compact('vehicleLifecycle')], 200);
    }
}
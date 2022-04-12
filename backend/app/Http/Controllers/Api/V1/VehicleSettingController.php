<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleSettings;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;

class VehicleSettingController extends Controller {

    public function index(Request $request)
    {
        $vehicleSettings = VehicleSettings::where('vehicle_id', $request->input('vehicle_id'))->get()->first();
        if ($vehicleSettings) {
            $vehicleSettings->secondary_meter_unit = $vehicleSettings->secondary_meter;
        }
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleSettings')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'vehicle_id' => 'required',
            'primary_meter' => 'required',
            'current_reading' => 'required',
            'average_usage_per_day' => 'required',
            'fuel_unit' => 'required',
            'measurement_unit' => 'required'
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
        $message = 'Vehicle Settings created';
        if (!$vehicleSettings = VehicleSettings::where('vehicle_id', $request->input('vehicle_id'))->get()->first()) {
            $vehicleSettings = new VehicleSettings;    
            $vehicleSettings->vehicle_id =$request->vehicle_id;
            $message = 'Vehicle Settings updated';
        }
        $vehicleSettings->primary_meter =$request->primary_meter;
        $vehicleSettings->current_reading =$request->current_reading;
        $vehicleSettings->average_usage_per_day =$request->average_usage_per_day;
        $vehicleSettings->auto_calculate =$request->auto_calculate;
        $vehicleSettings->secondary_meter_check =$request->secondary_meter_check;
        $vehicleSettings->secondary_meter =$request->secondary_meter_unit;
        $vehicleSettings->secondary_current_reading =$request->secondary_current_reading;
        $vehicleSettings->secondary_average_usage_per_day =$request->secondary_average_usage_per_day;
        $vehicleSettings->secondary_auto_calculate =$request->secondary_auto_calculate;
        $vehicleSettings->fuel_unit =$request->fuel_unit;
        $vehicleSettings->measurement_unit =$request->measurement_unit;
        $vehicleSettings->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Setting created', 'response'=> compact('vehicleSettings')], 200);
    }
}


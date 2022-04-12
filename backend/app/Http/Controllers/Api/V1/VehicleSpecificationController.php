<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleDetails;
use App\Models\V1\VehicleLifCycle;
use App\Models\V1\VehicleSpecification;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;

class VehicleSpecificationController extends Controller {

    public function index(Request $request)
    {
        $vehicleSpecifications = VehicleSpecification::where('vehicle_id', $request->input('vehicle_id'))->get()->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleSpecifications')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'vehicle_id' => 'required',
            'width' => 'required',
            'height' => 'required',
            'length' => 'required',
            'interior_valume' => 'required',
            'passenger_valume' => 'required',
            'ground_clearance' => 'required',
            'bed_length' => 'required',
            'curb_weight' => 'required',
            'gross_weight' => 'required',
            'towing_capacity' => 'required',
            'max_payload' => 'required',
            'epa_city' => 'required',
            'epa_highway' => 'required',
            'epa_combined' => 'required',
            'engine_summery' => 'required',
            'engine_brand' => 'required',
            'engine_aspiration' => 'required',
            'block_type' => 'required',
            'bore' => 'required',
            'cam_type' => 'required',
            'compression' => 'required',
            'cylinders' => 'required',
            'displacement' => 'required',
            'fuel_injection' => 'required',
            'max_hp' => 'required',
            'max_torque' => 'required',
            'redline_rpm' => 'required',
            'stroke' => 'required',
            'valves' => 'required',
            'transmission_summery' => 'required',
            'transmission_brand' => 'required',
            'transmission_type' => 'required',
            'transmission_gears' => 'required',
            'drive_type' => 'required',
            'brake_system' => 'required',
            'front_track_width' => 'required',
            'rear_track_width' => 'required',
            'wheelbase' => 'required',
            'front_wheel_diameter' => 'required',
            'rear_wheel_diameter' => 'required',
            'rar_axle' => 'required',
            'front_tyre_type' => 'required',
            'front_tyre_psi' => 'required',
            'rear_tyre_type' => 'required',
            'rear_tyre_psi' => 'required',
            'fuel_type' => 'required',
            'fuel_quality' => 'required',
            'fuel_tank_1_capacity' => 'required',
            'fuel_tank_2_capacity' => 'required',
            'oil_capacity' => 'required'
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
        $message = 'Vehicle Specification created';
        if (!$vehicleSpecifications = VehicleSpecification::where('vehicle_id', $request->input('vehicle_id'))->get()->first()) {
            $vehicleSpecifications = new VehicleSpecification;    
            $vehicleSpecifications->vehicle_id =$request->vehicle_id;
            $message = 'Vehicle Specification updated';
        }
        $vehicleSpecifications->vehicle_id =$request->vehicle_id;
        $vehicleSpecifications->width =$request->width;
        $vehicleSpecifications->height =$request->height;
        $vehicleSpecifications->length =$request->length;
        $vehicleSpecifications->interior_valume =$request->interior_valume;
        $vehicleSpecifications->passenger_valume =$request->passenger_valume;
        $vehicleSpecifications->ground_clearance =$request->ground_clearance;
        $vehicleSpecifications->bed_length =$request->bed_length;
        $vehicleSpecifications->curb_weight =$request->curb_weight;
        $vehicleSpecifications->gross_weight =$request->gross_weight;
        $vehicleSpecifications->towing_capacity =$request->towing_capacity;
        $vehicleSpecifications->max_payload =$request->max_payload;
        $vehicleSpecifications->epa_city =$request->epa_city;
        $vehicleSpecifications->epa_highway =$request->epa_highway;
        $vehicleSpecifications->epa_combined =$request->epa_combined;
        $vehicleSpecifications->engine_summery =$request->engine_summery;
        $vehicleSpecifications->engine_brand =$request->engine_brand;
        $vehicleSpecifications->engine_aspiration =$request->engine_aspiration;
        $vehicleSpecifications->block_type =$request->block_type;
        $vehicleSpecifications->bore =$request->bore;
        $vehicleSpecifications->cam_type =$request->cam_type;
        $vehicleSpecifications->compression =$request->compression;
        $vehicleSpecifications->cylinders =$request->cylinders;
        $vehicleSpecifications->displacement =$request->displacement;
        $vehicleSpecifications->fuel_injection =$request->fuel_injection;
        $vehicleSpecifications->max_hp =$request->max_hp;
        $vehicleSpecifications->max_torque =$request->max_torque;
        $vehicleSpecifications->redline_rpm =$request->redline_rpm;
        $vehicleSpecifications->stroke =$request->stroke;
        $vehicleSpecifications->valves =$request->valves;
        $vehicleSpecifications->transmission_summery =$request->transmission_summery;
        $vehicleSpecifications->transmission_brand =$request->transmission_brand;
        $vehicleSpecifications->transmission_type =$request->transmission_type;
        $vehicleSpecifications->transmission_gears =$request->transmission_gears;
        $vehicleSpecifications->drive_type =$request->drive_type;
        $vehicleSpecifications->brake_system =$request->brake_system;
        $vehicleSpecifications->front_track_width =$request->front_track_width;
        $vehicleSpecifications->rear_track_width =$request->rear_track_width;
        $vehicleSpecifications->wheelbase =$request->wheelbase;
        $vehicleSpecifications->front_wheel_diameter =$request->front_wheel_diameter;
        $vehicleSpecifications->rear_wheel_diameter =$request->rear_wheel_diameter;
        $vehicleSpecifications->rar_axle =$request->rar_axle;
        $vehicleSpecifications->front_tyre_type =$request->front_tyre_type;
        $vehicleSpecifications->front_tyre_psi =$request->front_tyre_psi;
        $vehicleSpecifications->rear_tyre_type =$request->rear_tyre_type;
        $vehicleSpecifications->rear_tyre_psi =$request->rear_tyre_psi;
        $vehicleSpecifications->fuel_type =$request->fuel_type;
        $vehicleSpecifications->fuel_quality =$request->fuel_quality;
        $vehicleSpecifications->fuel_tank_1_capacity =$request->fuel_tank_1_capacity;
        $vehicleSpecifications->fuel_tank_2_capacity =$request->fuel_tank_2_capacity;
        $vehicleSpecifications->oil_capacity =$request->oil_capacity;
        $vehicleSpecifications->save();
        return Response()->json(['status'=>true,'message'=> $message, 'response'=> compact('vehicleSpecifications')], 200);
    }
}
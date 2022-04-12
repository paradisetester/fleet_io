<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleAssignment;
use Illuminate\Validation\Rule;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait,
};

class vehicleAssignmentController extends Controller {
    use HelperTrait, UserTrait;
    public function index(Request $request)
    {
        $vehicleAssignments = VehicleAssignment::join('vehicle_details','vehicle_details.vehicle_id','vehicle_assignments.vehicle_id')->select('vehicle_assignments.*','vehicle_details.name as vehicleName')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleAssignments')], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }        
        $vehicleAssignment = $this->insertUpdateAssignment($request);
        return Response()->json(['status'=>true,'message'=>'Vehicle Assigned', 'response'=> compact('vehicleAssignment')], 200);
    }
    public function edit($id)
    {
        $vehicleAssignment = VehicleAssignment::find($id);
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleAssignment')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vehicleAssignment = $this->insertUpdateAssignment($request, $id);
        return Response()->json(['status'=>true,'message'=>'Vehicle Assigned', 'response'=>compact('vehicleAssignment')], 200);
    }
    public function destroy(Request $request, $id)
    {        
        $vehicleAssignment = VehicleAssignment::find($id);
        $vehicleAssignment->delete();
        return Response()->json(['status'=>true,'message'=>'Vehicle Assigned Deleted', 'response'=>[]], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'vehicle_id' => 'required|exists:vehicle_details,vehicle_id',
            'contact_id' => 'required|exists:vendors,vendor_id',
            'start_date' => 'required',
            'start_time' => 'required',
            'starting_odometer' => 'required|numeric',
            'end_date' => 'required',
            'end_time' => 'required',
            'ending_odometer' => 'required|numeric'
        ];
        return $rules;
    }
    public function insertUpdateAssignment($request, $id = null)
    {
        if(!$vehicleAssignment = VehicleAssignment::find($id))
        {
            $vehicleAssignment = new VehicleAssignment;
        }
        $vehicleAssignment->vehicle_id =$request->vehicle_id;
        $vehicleAssignment->contact_id = $request->contact_id;
        $vehicleAssignment->user_id = $this->getCurrentUserID();
        $vehicleAssignment->send_email_notification = 0;
        $vehicleAssignment->start_date = date('Y-m-d', strtotime($request->start_date));
        $vehicleAssignment->start_time = date('H:i:s', strtotime($request->start_time));
        $vehicleAssignment->starting_odometer = $request->starting_odometer;
        $vehicleAssignment->end_date = date('Y-m-d', strtotime($request->end_date));
        $vehicleAssignment->end_time = date('H:i:s', strtotime($request->end_time));
        $vehicleAssignment->ending_odometer = $request->ending_odometer;
        $vehicleAssignment->comment = $request->comment;
        $vehicleAssignment->save();
        return $vehicleAssignment;
    }
}


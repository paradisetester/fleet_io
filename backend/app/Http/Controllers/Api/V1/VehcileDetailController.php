<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleDetails;
use App\Models\V1\VehicleLifCycle;
use App\Models\V1\VehicleSpecification;
use App\Models\V1\VehicleSettings;
use App\Models\V1\VehicleAssignment;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};

class VehcileDetailController extends Controller {
    use HelperTrait, UserTrait;
    
    public function index()
    {
        $vehicleDetails = VehicleDetails::with('contactby')->get();	
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleDetails')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',
            'vin' => 'required',
            'license_plate' => 'required|string',
            'type' => 'required|string',           
            // 'make_id' => 'required|string',
            // 'model_id' => 'required|string',
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
        $vehicleDetail = new VehicleDetails;
        $vehicleDetail->name =$request->name;
        $vehicleDetail->vin = $request->vin;
        $vehicleDetail->type = $request->type;
        $vehicleDetail->license_plate = $request->license_plate;
        $vehicleDetail->make_id = $request->make_id;
        $vehicleDetail->model_id = $request->model_id;
        $vehicleDetail->year = $request->year;
        $vehicleDetail->trim_id = $request->trim_id;
        $vehicleDetail->registration_state = $request->registration_state;
        if ($request->pageFile) {
            $vehicleDetail->registration_photo = $this->fileuploadExtra($request, 'pageFile');
        }
        $vehicleDetail->service_program = $request->service_program;
        $vehicleDetail->status = $request->status;
        $vehicleDetail->group_id = $request->group_id;
        $vehicleDetail->contact_id = $request->contact_id;
        $vehicleDetail->ownership = $request->ownership;
        $vehicleDetail->color = $request->color;
        $vehicleDetail->body_type_id = $request->body_type_id;
        $vehicleDetail->body_sub_type_id = $request->body_sub_type_id;
        $vehicleDetail->msrp = $request->msrp;
        $vehicleDetail->purchase_price = $request->purchase_price;
        $vehicleDetail->linked_vehicle_id = $request->linked_vehicle_id;
        $vehicleDetail->save();

        return Response()->json(['status'=>true,'message'=>'Vehicle Details created', 'response'=>compact('vehicleDetail')], 200);
    }

    public function edit($id)
    {
        $vehicleDetail = VehicleDetails::find($id);
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vehicleDetail')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vehicleDetail = VehicleDetails::find($id);
        $vehicleDetail->name =$request->name;
        $vehicleDetail->vin = $request->vin;
        $vehicleDetail->license_plate = $request->license_plate;
        $vehicleDetail->type = $request->type;
        $vehicleDetail->make_id = $request->make_id;
        $vehicleDetail->model_id = $request->model_id;
        $vehicleDetail->trim_id = $request->trim_id;
        $vehicleDetail->year = $request->year;
        $vehicleDetail->registration_state = $request->registration_state;
        if ($request->pageFile) {
            $vehicleDetail->registration_photo = $this->fileuploadExtra($request, 'pageFile');
        }
        $vehicleDetail->service_program = $request->service_program;
        $vehicleDetail->status = $request->status;
        $vehicleDetail->group_id = $request->group_id;
        $vehicleDetail->contact_id = $request->contact_id;
        $vehicleDetail->ownership = $request->ownership;
        $vehicleDetail->color = $request->color;
        $vehicleDetail->body_type_id = $request->body_type_id;
        $vehicleDetail->body_sub_type_id = $request->body_sub_type_id;
        $vehicleDetail->msrp = $request->msrp;
          $vehicleDetail->purchase_price = $request->purchase_price;
        
        $vehicleDetail->linked_vehicle_id = $request->linked_vehicle_id;
        $vehicleDetail->save();
        return Response()->json(['status'=>true,'message'=>'Vehicle Details updated', 'response'=>compact('vehicleDetail')], 200);
    }
    public function destroy(Request $request, $id)
    {        
        VehicleSettings::where('vehicle_id', $id)->delete();
        VehicleLifCycle::where('vehicle_id', $id)->delete();
        VehicleSpecification::where('vehicle_id', $id)->delete();
        VehicleAssignment::where('vehicle_id', $id)->delete();
        
        // $vehicleDetail = VehicleDetails::find($id);
        // $vehicleDetail->save();
        $vehicleDetail = VehicleDetails::where('vehicle_id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Vehicle Details Deleted', 'response'=>[]], 200);
    }

}
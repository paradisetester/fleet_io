<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleInspectionItems;
use App\Models\V1\VehicleInspection;

use Validator,
    DateTime,
    Config,
    Hash,
    DB,
    Session,
    Auth,
    Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};

class InspectionController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $vehicleInspections = VehicleInspection::select(
                'vehicle_inspections.created_at','vehicle_inspections.inspection_id',
                DB::raw("(SELECT title FROM inspection_templates where inspection_templates.id = vehicle_inspections.inspection_template_id) AS template_name"),
                DB::raw("(SELECT name FROM vehicle_details where vehicle_details.vehicle_id = vehicle_inspections.vehicle_id) AS vehicle_name"),
                DB::raw("(SELECT name FROM users where users.id = vehicle_inspections.user_id) AS user_name")
            )
            ->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('vehicleInspections')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'vehicle_id' => 'required',
            'fields' => 'required',
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $inspection = new VehicleInspection;
        $inspection->vehicle_id = $request->vehicle_id;
        $inspection->inspection_template_id = $request->inspection_template_id;
        $inspection->user_id = $this->getCurrentUserID();
        $inspection->save();

        $vehicleInspection = new VehicleInspectionItems;
        $vehicleInspection->vehicle_id = $request->vehicle_id;
        $vehicleInspection->inspection_id = $inspection->inspection_id;
        $vehicleInspection->fields = $request->fields;
        $vehicleInspection->save();
        return Response()->json(['status' => true, 'message' => 'Inspection created', 'response' => []], 200);
    }

    public function edit($id) {
        $inspection = VehicleInspection::find($id);
        $vehicleInspection = VehicleInspectionItems::where('inspection_id', $inspection->inspection_id)->get()->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('vehicleInspection')], 200);
    }

    public function show($id) {
        $inspection = VehicleInspection::find($id);
     
        $vehicleInspection = VehicleInspectionItems::where('inspection_id', $inspection->inspection_id)->get()->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('vehicleInspection')], 200);
    }

 
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $inspection = VehicleInspection::find($id);
        $vehicleInspection = VehicleInspectionItems::where('inspection_id', $inspection->inspection_id)->get()->first();
        $vehicleInspection->vehicle_id = $request->vehicle_id;
        $vehicleInspection->fields = $request->fields;
        $vehicleInspection->save();

        return Response()->json(['status' => true, 'message' => 'Inspection updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $inspection = VehicleInspection::find($id);
        $vehicleInspection = VehicleInspectionItems::where('inspection_id', $inspection->inspection_id)->get()->first();
        if ($vehicleInspection) {
            $vehicleInspection->delete();
        }        
        $inspection->delete();
        return Response()->json(['status' => true, 'message' => 'Inspection Deleted', 'response' => []], 200);
    }
	
   public function uploadFile(Request $request) {
	   
	   if($request->deletes == 'delete'){
		    $destinationPath =str_replace('public','',$request->image);
			  $destinationPath = public_path($destinationPath);
			 if(file_exists($destinationPath))
			   {				 
				  File::delete($destinationPath);		  
			   }
		   return Response()->json(['status' => true, 'message' => 'Delete successfully'], 200);
	   }else{
		    if ($request->photos) {
					$image = $this->fileuploadExtra($request, 'photos');		  
					return Response()->json(['image' => $image,'index'=>$request->index], 200);
				}
	   }
		
	}
	

	
}

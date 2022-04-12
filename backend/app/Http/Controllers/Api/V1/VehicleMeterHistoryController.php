<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleMeterHistory;
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

class VehicleMeterHistoryController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $vehiclemeterhistory = VehicleMeterHistory::with('vehiclename')->orderBy('meter_id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('vehiclemeterhistory')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'vehicle_id' => 'required',           
            'date' => 'required',
            'odometer_reading' => 'required', 
        ];
        return $rules;
    }

    public function store(Request $request) {
		
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $vehiclemeterhistory = new VehicleMeterHistory;
        $vehiclemeterhistory->vehicle_id = $request->vehicle_id;     
        $vehiclemeterhistory->date = date('Y-m-d', strtotime($request->date));       
        $vehiclemeterhistory->odometer_reading = $request->odometer_reading;   
        $vehiclemeterhistory->save();
        return Response()->json(['status' => true, 'message' => 'Vehicle Meter created', 'response' => []], 200);
    }

    public function edit($id) {
        $vehiclemeterhistory = VehicleMeterHistory::where('meter_id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('vehiclemeterhistory')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $vehiclemeterhistory = VehicleMeterHistory::where('meter_id', $id)->first();
        $vehiclemeterhistory->vehicle_id = $request->vehicle_id;       
        $vehiclemeterhistory->date = date('Y-m-d', strtotime($request->date));       
        $vehiclemeterhistory->odometer_reading = $request->odometer_reading;
        $vehiclemeterhistory->save();
        return Response()->json(['status' => true, 'message' => 'Vehicle Meter History updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $vehiclemeterhistory = VehicleMeterHistory::where('meter_id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Vehicle Meter History Deleted', 'response' => []], 200);
    }

}

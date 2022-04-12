<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\ServiceReminder;
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

class VehicleRenewalRemindersController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $VehicleReminder = ServiceReminder::with('vehicleName')->where('service_type','vehicle')->orderBy('id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('VehicleReminder')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'vehicle_id' => 'required',           
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $VehicleReminder = new ServiceReminder;
        $VehicleReminder->vehicle_id = $request->vehicle_id;
        $VehicleReminder->user_ids = $request->user_ids;
        $VehicleReminder->service_type ='vehicle';
        $VehicleReminder->renewal_type = $request->renewal_type;
        $VehicleReminder->time_threshold = $request->time_threshold;
        $VehicleReminder->week = $request->week;
        $VehicleReminder->date = date('Y-m-d', strtotime($request->date)); 
        $VehicleReminder->save();
        return Response()->json(['status' => true, 'message' => 'VehicleReminder created', 'response' => []], 200);
    }

    public function edit($id) {
        $VehicleReminder = ServiceReminder::where('id', $id)->where('service_type','vehicle')->first();
        $VehicleReminder->name = $VehicleReminder->vehicle->name;
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('VehicleReminder')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $VehicleReminder = ServiceReminder::where('id', $id)->first();
        $VehicleReminder->vehicle_id = $request->vehicle_id;
        $VehicleReminder->user_ids = $request->user_ids;
        $VehicleReminder->service_type ='vehicle';
        $VehicleReminder->renewal_type = $request->renewal_type;
        $VehicleReminder->time_threshold = $request->time_threshold;
        $VehicleReminder->week = $request->week;
        $VehicleReminder->date = date('Y-m-d', strtotime($request->date)); 
        $VehicleReminder->save();
        return Response()->json(['status' => true, 'message' => 'VehicleReminder updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $VehicleReminder = ServiceReminder::where('id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'VehicleReminder Deleted', 'response' => []], 200);
    }

}

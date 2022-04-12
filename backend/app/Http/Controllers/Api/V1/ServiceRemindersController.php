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

class ServiceRemindersController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $ServiceReminder = ServiceReminder::with('vehicleName')->where('service_type','service')->orderBy('id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('ServiceReminder')], 200);
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
        $ServiceReminder = new ServiceReminder;
        $ServiceReminder->vehicle_id = $request->vehicle_id;
        $ServiceReminder->user_ids = $request->user_ids;
        $ServiceReminder->service_type ='service';
        $ServiceReminder->renewal_type = $request->renewal_type;
        $ServiceReminder->time_threshold = $request->time_threshold;
        $ServiceReminder->week = $request->week;
        $ServiceReminder->date = date('Y-m-d', strtotime($request->date)); 
        $ServiceReminder->save();
        return Response()->json(['status' => true, 'message' => 'ServiceReminder created', 'response' => []], 200);
    }

    public function edit($id) {
        $ServiceReminder = ServiceReminder::where('id', $id)->first();
        $ServiceReminder->name = $ServiceReminder->vehicle->name;
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('ServiceReminder')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $ServiceReminder = ServiceReminder::where('id', $id)->first();
              $ServiceReminder->vehicle_id = $request->vehicle_id;
        $ServiceReminder->user_ids = $request->user_ids;
        $ServiceReminder->service_type ='service';
        $ServiceReminder->renewal_type = $request->renewal_type;
        $ServiceReminder->time_threshold = $request->time_threshold;
        $ServiceReminder->week = $request->week;
        $ServiceReminder->date = date('Y-m-d', strtotime($request->date)); 
        $ServiceReminder->save();     
        return Response()->json(['status' => true, 'message' => 'ServiceReminder updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $ServiceReminder = ServiceReminder::where('id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'ServiceReminder Deleted', 'response' => []], 200);
    }

}

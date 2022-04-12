<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Fuel;
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

class FuelController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $fuel = Fuel::with('vehiclename')->orderBy('fuel_id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('fuel')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'vehicle_id' => 'required',
            'user_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'odometer' => 'required',
            'price' => 'required',
            'fuel_type' => 'required',
            'vendor_id' => 'required',
            'reference' => 'required',
            'personal' => 'required',
            'partial_fuel_up' => 'required'            
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $fuel = new Fuel;
        $fuel->vehicle_id = $request->vehicle_id;
        $fuel->user_id = $request->user_id;
        $fuel->date = date('Y-m-d', strtotime($request->date));
        $fuel->time = $request->time;
        $fuel->odometer = $request->odometer;
        $fuel->price = $request->price;
        $fuel->fuel_type = $request->fuel_type;
        $fuel->vendor_id = $request->vendor_id;
        $fuel->reference = $request->reference;
        $fuel->personal = $request->personal;
        $fuel->litres = $request->litres;
        $fuel->partial_fuel_up = $request->partial_fuel_up;
        if ($request->pageFile) {
            $fuel->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        if ($request->pageDocFile) {
            $fuel->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        $fuel->comment = $request->comment;
        $fuel->save();
        return Response()->json(['status' => true, 'message' => 'Fuel created', 'response' => []], 200);
    }

    public function edit($id) {
        $fuel = Fuel::where('fuel_id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('fuel')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $fuel = Fuel::where('fuel_id', $id)->first();
        $fuel->vehicle_id = $request->vehicle_id;
        $fuel->user_id = $request->user_id;
        $fuel->date = date('Y-m-d', strtotime($request->date));
        $fuel->time = $request->time;
        $fuel->odometer = $request->odometer;
        $fuel->price = $request->price;
        $fuel->fuel_type = $request->fuel_type;
        $fuel->vendor_id = $request->vendor_id;
        $fuel->reference = $request->reference;
        $fuel->personal = $request->personal;
        $fuel->litres = $request->litres;
        if ($request->pageFile) {
            $fuel->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        else
        {
            $fuel->photo = Null;
        }
        if ($request->pageDocFile) {
            $fuel->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        else
        {
            $fuel->document = Null;
        }
        $fuel->partial_fuel_up = $request->partial_fuel_up;
        $fuel->comment = $request->comment;
        $fuel->save();
        return Response()->json(['status' => true, 'message' => 'Fuel updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $fuel = Fuel::where('fuel_id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Fuel Deleted', 'response' => []], 200);
    }

}

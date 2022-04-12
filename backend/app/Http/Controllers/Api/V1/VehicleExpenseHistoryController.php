<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\VehicleExpenseHistory;
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

class VehicleExpenseHistoryController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $VehicleExpenseHistory = VehicleExpenseHistory::with('vehiclename')->orderBy('expense_id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('VehicleExpenseHistory')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'vehicle_id' => 'required',           
            'date' => 'required',
            'time' => 'required',            
            'price' => 'required',
            'expense_type' => 'required',
            'vendor_id' => 'required',
            // 'document' => 'required',
            // 'photo' => 'required'
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $VehicleExpenseHistory = new VehicleExpenseHistory;
        $VehicleExpenseHistory->vehicle_id = $request->vehicle_id;    
        
        if ($request->time != 'null') {
            $VehicleExpenseHistory->time = $request->time;
        }
        if ($request->date != 'undefined') {
            $VehicleExpenseHistory->date = date('Y-m-d', strtotime($request->date));
        }

        $VehicleExpenseHistory->start_date = date('Y-m-d', strtotime($request->start_date));
        $VehicleExpenseHistory->end_date = date('Y-m-d', strtotime($request->end_date)); 
        $VehicleExpenseHistory->price = $request->price;
        $VehicleExpenseHistory->expense_type = $request->expense_type;
        $VehicleExpenseHistory->vendor_id = $request->vendor_id;
        $VehicleExpenseHistory->recurring = $request->recurring;
        $VehicleExpenseHistory->frequency = $request->frequency;
        
        if ($request->pageFile) {
            $VehicleExpenseHistory->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        if ($request->pageDocFile) {
            $VehicleExpenseHistory->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        $VehicleExpenseHistory->comment = $request->comment;
        $VehicleExpenseHistory->notes = $request->notes;
        $VehicleExpenseHistory->save();
        return Response()->json(['status' => true, 'message' => 'Vehicle Expense created', 'response' => []], 200);
    }

    public function edit($id) {
        $VehicleExpenseHistory = VehicleExpenseHistory::where('expense_id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('VehicleExpenseHistory')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $VehicleExpenseHistory = VehicleExpenseHistory::where('expense_id', $id)->first();
        $VehicleExpenseHistory->vehicle_id = $request->vehicle_id;    
        
        if ($request->time != 'null') {
            $VehicleExpenseHistory->time = $request->time;
        }
        if ($request->date != 'undefined') {
            $VehicleExpenseHistory->date = date('Y-m-d', strtotime($request->date));
        }

        $VehicleExpenseHistory->start_date = date('Y-m-d', strtotime($request->start_date));
        $VehicleExpenseHistory->end_date = date('Y-m-d', strtotime($request->end_date)); 
        $VehicleExpenseHistory->price = $request->price;
        $VehicleExpenseHistory->expense_type = $request->expense_type;
        $VehicleExpenseHistory->vendor_id = $request->vendor_id;
        $VehicleExpenseHistory->recurring = $request->recurring;
        $VehicleExpenseHistory->frequency = $request->frequency;
        
        if ($request->file('pageFile') != null) {
            $VehicleExpenseHistory->photo = $this->fileuploadExtra($request, 'pageFile');
        } else {
            $VehicleExpenseHistory->photo = $request->pageFile;
        }
        if ($request->file('pageDocFile') != null) {
            $VehicleExpenseHistory->document = $this->fileuploadExtra($request, 'pageDocFile');
        } else {
            $VehicleExpenseHistory->document = $request->pageDocFile;
        }

        $VehicleExpenseHistory->comment = $request->comment;
        $VehicleExpenseHistory->notes = $request->notes;
        $VehicleExpenseHistory->save();
        $VehicleExpenseHistory->save();
        return Response()->json(['status' => true, 'message' => 'VehicleExpenseHistory updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $VehicleExpenseHistory = VehicleExpenseHistory::where('expense_id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'VehicleExpenseHistory Deleted', 'response' => []], 200);
    }

}

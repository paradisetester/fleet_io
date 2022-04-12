<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\InspectionTemplate;
use App\Models\V1\InspectionTemplateItems;
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

class InspectionTemplateItemsController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index($id) {
        $inspectionItems = InspectionTemplateItems::where('inspection_template_id', $id)->all();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('inspectionItems')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'inspection_template_id' => 'required',
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
        if (!$inspectionItems = InspectionTemplateItems::where('inspection_template_id', $request->inspection_template_id)->first()) {
            $inspectionItems = new InspectionTemplateItems;
        }        
        $inspectionItems->user_id = $this->getCurrentUserID();
        $inspectionItems->inspection_template_id = $request->inspection_template_id;
        $inspectionItems->fields = $request->fields;
        $inspectionItems->save();
        return Response()->json(['status' => true, 'message' => 'Inspection Templates created', 'response' => []], 200);
    }

    public function edit($id) {
        $inspectionItems = InspectionTemplateItems::where('inspection_template_id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('inspectionItems')], 200);
    }

    public function show($id) {
        $inspectionItems = InspectionTemplateItems::where('inspection_template_id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('inspectionItems')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $inspectionItems = InspectionTemplateItems::where('inspection_template_id', $id)->first();
        $inspectionItems->user_id = $this->getCurrentUserID();
        $inspectionItems->inspection_template_id = $request->inspection_template_id;
        $inspectionItems->fields = $request->fields;
        $inspectionItems->save();

        return Response()->json(['status' => true, 'message' => 'Inspection Templatese updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $inspectionItems = InspectionTemplateItems::where('id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Inspection Templates Deleted', 'response' => []], 200);
    }

}

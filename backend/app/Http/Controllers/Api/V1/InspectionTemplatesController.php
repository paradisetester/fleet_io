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

class InspectionTemplatesController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $inspectiontemplates = InspectionTemplate::all();
        return Response()->json(['status' => true, 'message' => 'Inspection List', 'response' => compact('inspectiontemplates')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'title' => 'required|string',
            'description' => 'required'
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $inspectiontemplates = new InspectionTemplate;
        $inspectiontemplates->title = $request->title;
        $inspectiontemplates->description = $request->description;
        $inspectiontemplates->user_id = $this->getCurrentUserID();
        $inspectiontemplates->save();
        return Response()->json(['status' => true, 'message' => 'Inspection Templates created', 'response' => $inspectiontemplates], 200);
    }

    public function edit($id) {
        $inspectiontemplate = InspectionTemplate::find($id);
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('inspectiontemplate')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $inspectiontemplates = InspectionTemplate::find($id);
        $inspectiontemplates->title = $request->title;
        $inspectiontemplates->description = $request->description;
        $inspectiontemplates->save();
        return Response()->json(['status' => true, 'message' => 'Inspection Templatese updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $inspectiontemplate = InspectionTemplate::where('id', $id)->delete();
        $inspectiontemplates = InspectionTemplateItems::where('inspection_template_id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Inspection Templates Deleted', 'response' => []], 200);
    }

}

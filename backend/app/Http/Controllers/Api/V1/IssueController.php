<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Issues;
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

class IssueController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $issue = Issues::with('issue')->with('assigned_by_name')->with('reported_by_name')->orderBy('issue_id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('issue')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'vehicle_id' => 'required',
            // 'user_id' => 'required',
            'reported_date' => 'required',
            'summery' => 'required',
            'description' => 'required',
            'odometer' => 'required',
            'labels' => 'required',
            'reported_by' => 'required',
            'assigned_to' => 'required'
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $issue = new Issues;
        $issue->vehicle_id = $request->vehicle_id;
        // $issue->user_id =$request->user_id;
        $issue->user_id = 1;
        $issue->reported_date = date('Y-m-d', strtotime($request->reported_date));
        $issue->summery = $request->summery;
        $issue->description = $request->description;
        $issue->odometer = $request->odometer;
        $issue->labels = $request->labels;
        $issue->reported_by = $request->reported_by;
        $issue->assigned_to = $request->assigned_to;
        if ($request->pageFile) {
            $issue->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        if ($request->pageDocFile) {
            $issue->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        $issue->save();
        return Response()->json(['status' => true, 'message' => 'Issue created', 'response' => []], 200);
    }

    public function edit($id) {
        $issue = Issues::where('issue_id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('issue')], 200);
    }

    public function update(Request $request, $id) {
        $request->all();
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $issue = Issues::where('issue_id', $id)->first();
        $issue->vehicle_id = $request->vehicle_id;
        // $issue->user_id =$request->user_id;
        $issue->user_id = 1;
        $issue->reported_date = date('Y-m-d', strtotime($request->reported_date));
        $issue->summery = $request->summery;
        $issue->description = $request->description;
        $issue->odometer = $request->odometer;
        $issue->labels = $request->labels;
        $issue->reported_by = $request->reported_by;
        $issue->assigned_to = $request->assigned_to;
        if ($request->pageFile) {
            $issue->photo = $this->fileuploadExtra($request, 'pageFile');
        }
         else
        {
        if ($issue->photo) {

        $issue->photo;
        }
        $issue->photo = Null;
        }
        if ($request->pageDocFile) {
            $issue->document = $this->fileuploadExtra($request, 'pageDocFile');
        }
        else
        {
            if ($issue->document) {

                $issue->document;
            }
            $issue->document = Null;
        }
        $issue->save();
        return Response()->json(['status' => true, 'message' => 'Issue updated', 'response' => []], 200);
    }



    public function destroy(Request $request, $id) {
        $issue = Issues::where('issue_id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Issue Deleted', 'response' => []], 200);
    }

}

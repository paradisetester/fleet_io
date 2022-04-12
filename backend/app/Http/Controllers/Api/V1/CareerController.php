<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Career;
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

class CareerController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $career = Career::all();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('career')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'cover_letter' => 'required|string',
            // 'resume' => 'required',
            'apply_for' => 'required|string',
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $career = new Career;
        $career->first_name = $request->first_name;
        $career->last_name = $request->last_name;
        $career->phone = $request->phone;
        $career->email = $request->email;
        $career->cover_letter = $request->cover_letter;
        if ($request->pageFile) {
            $career->resume = $this->fileuploadExtra($request, 'pageFile');
        }
        $career->apply_for = $request->apply_for;
        $career->save();
        return Response()->json(['status' => true, 'message' => 'Thank you for apply', 'response' => []], 200);
    }

    public function edit($id) {
        $career = Career::where('id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('career')], 200);
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $career = Career::where('id', $id)->first();
        $career->first_name = $request->first_name;
        $career->last_name = $request->last_name;
        $career->phone = $request->phone;
        $career->email = $request->email;
        $career->cover_letter = $request->cover_letter;
        if ($request->pageFile) {
            $career->resume = $this->fileuploadExtra($request, 'pageFile');
        }
        $career->apply_for = $request->apply_for;
        $career->save();
        return Response()->json(['status' => true, 'message' => 'Career updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $career = Career::where('id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Career Deleted', 'response' => []], 200);
    }

}

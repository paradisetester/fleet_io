<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\ContactRenewal;
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
class ContactRenewalReminderController extends Controller {

    use HelperTrait,
        UserTrait;

    public function index() {
        $ContactRenewal = ContactRenewal::orderBy('id', 'ASC')->get();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('ContactRenewal')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
               
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $ContactRenewal = new ContactRenewal;
        $ContactRenewal->contact_name = $request->contact_name;
        $ContactRenewal->contact_type = $request->contact_type;
        $ContactRenewal->due_date = date('Y-m-d', strtotime($request->due_date)); 
        $ContactRenewal->save();
        return Response()->json(['status' => true, 'message' => 'Contact Reminder created', 'response' => []], 200);
    }

    public function edit($id) {
        $ContactRenewal = ContactRenewal::where('id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('ContactRenewal')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $ContactRenewal = ContactRenewal::where('id', $id)->first();
        $ContactRenewal->contact_name = $request->contact_name;
        $ContactRenewal->contact_type = $request->contact_type;
        $ContactRenewal->due_date = date('Y-m-d', strtotime($request->due_date)); 
        $ContactRenewal->save();
        return Response()->json(['status' => true, 'message' => 'Contact Reminder updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $ContactRenewal = ContactRenewal::where('id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'Contact Reminder Deleted', 'response' => []], 200);
    }

}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\ContactUs;
use Validator,
    DateTime,
    Config,
    Hash,
    DB,
    Session,
    Auth,
    Redirect;

class ContactUsController extends Controller {

    public function index() {
        $contactus = ContactUs::all();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('contactus')], 200);
    }

    public static function storeRules($request, $id = null) {
        $rules = [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string',
            'phoneno' => 'required|string',
            'message' => 'required|string',
        ];
        return $rules;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $contactus = new ContactUs;
        $contactus->firstname = $request->firstname;
        $contactus->lastname = $request->lastname;
        $contactus->email = $request->email;
        $contactus->phoneno = $request->phoneno;
        $contactus->message = $request->message;
        $contactus->save();
        return Response()->json(['status' => true, 'message' => 'ContactUs created', 'response' => []], 200);
    }

    public function edit($id) {
        $contactus = ContactUs::where('id', $id)->first();
        return Response()->json(['status' => true, 'message' => '', 'response' => compact('contactus')], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status' => false, 'message' => $errors, 'response' => []], 401);
        }
        $contactus = ContactUs::where('id', $id)->first();
        $contactus->firstname = $request->firstname;
        $contactus->lastname = $request->lastname;
        $contactus->email = $request->email;
        $contactus->phoneno = $request->phoneno;
        $contactus->message = $request->message;
        $contactus->save();
        return Response()->json(['status' => true, 'message' => 'ContactUs updated', 'response' => []], 200);
    }

    public function destroy(Request $request, $id) {
        $contactus = ContactUs::where('id', $id)->delete();
        return Response()->json(['status' => true, 'message' => 'ContactUs Deleted', 'response' => []], 200);
    }

}

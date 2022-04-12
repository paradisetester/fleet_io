<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\User;
use App\Traits\{
    UserTrait,
};
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;


class UserController extends Controller {
    use UserTrait;
    public function index()
    {
        $users = $this->getUsers();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('users')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[
            'name' => 'required',        
            'email' => 'required',
            'password' => 'required'       
        ];
        return $rules;
    }
    public function store(Request $request)
    {
        return $this->insertUpdateUserDetail($request, 'insert');
    }

    public function edit(Request $request, $id)
    {
        $user = $this->getUserData($id, NULL, $request->header('tenantId'));
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('user')], 200);
    }

    public function update(Request $request, $id)
    {
        return $this->insertUpdateUserDetail($request, 'update', $id);
    }

    public function destroy(Request $request, $id)
    {
        $user = $this->deleteUser($request, $id);
        return Response()->json(['status'=>true,'message'=>'User Deleted', 'response'=>[]], 200);
    }

    public function show(Request $request){
        $user = $this->getUserData(NULL, NULL, $request->header('tenantId'));
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('user')], 200);
    }

    private function insertUpdateUserDetail($request, $action = 'update', $id = NULL){
        $type = $request->get('type');
        $id = $id ? $id :$request->get('user_id');
        $validator = Validator::make($request->all(), $this->validationRules($type, $id));
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }

        $user = $this->saveUserDetail($request, $id);
        if($user){
            $message = $action == 'update' ? 'User updated successfully!' : 'User inserted successfully!';
            return Response()->json(['status'=>true,'message'=>$message, 'response'=>['user' => $user]], 200);
        }
        return Response()->json(['status'=>false,'message'=>'Sorry! Server Not Responde', 'response'=>[]], 401);
    }

    private function validationRules($type = null, $id = NULL){
        $email = $id ? 'required|email' : 'required|email|unique:users';
        $rules = [
            'basic' => [
                'name' => 'required|min:3',
                'email' => $email,
                // 'employee' => 'required|min:3',
                // 'operator' => 'required|min:3',
            ],
            'user_management' => [
                'enable' => 'required',
            ],
            'contact' => [
                'mobile' => 'required|min:10',
                'address1' => 'required|min:3',
                'city' => 'required|min:3',
                'state' => 'required|min:3',
                'postal_code' => 'required|min:3',
                'country' => 'required|min:3',
            ],
            'personal' => [
                'job_title' => 'required|min:3',
                'dob' => 'required|min:3',
                // 'employee' => [
                //     'number' => 'required|min:3',
                //     'start_date' => 'required|min:3',
                //     'leave_date' => 'required|min:3',
                // ],
                // 'operator' => [
                //     'license_number' => 'required|min:3',
                //     'license_class' => 'required|min:3',
                //     'license_state' => 'required|min:3'
                // ],
                'labour_rate' => 'required',
            ],
            'password' => [
                'password' => 'required|min:6|max:14|confirmed',
                'password_confirmation' => 'required',
            ]
        ];
        if($type){
            return isset($rules[$type]) ? $rules[$type] : [];
        }
        return $rules;
    }
}


<?php

namespace App\Traits;
use Auth, Hash;
use App\Models\User;
use App\Models\UsersDetail;
use App\Models\TenantMgmt;
use App\Models\TanantUser;
use App\Models\SiteDetails;
use App\Models\Payment;
use App\Traits\HelperTrait;
use Illuminate\Support\Str;

trait UserTrait {
    use HelperTrait;

    public function getCurrentUserName(){
        if (Auth::user()) {
            return Auth::user()->name;
        }
        return;
    }
    public function getCurrentUserEmail(){
        if (Auth::user()) {
            return Auth::user()->email;
        }
        return;
    }
    public function getCurrentUserID(){
    	if (Auth::user()) {
            return Auth::user()->id;
        }
        return 0;        
    }
    public function getUsers()
    {
        $currentId = $this->getCurrentUserID();
        return User::whereNotIn('id', [$currentId])->orderBy('updated_at', 'DESC')->get();
    }
    public function getUser($id)
    {
        return User::find($id);
    }
    public function insertUpdateUser($request, $id = null)
    {
        if (!$user = $this->getUser($id)) {
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $password = FALSE;
        if($user->password != $request->password){
            $user->password = Hash::make($request->password);
            $password = $user->password;
        }
        if($user->save()){
            $this->tenantUserOfFleetAdmin($request, 'add-update', $password);
        }
        return $user;
    }
    public function deleteUser($request, $id)
    {
        $user = $this->getUser($id);
        $request->merge(['email' => $user->email]); 
        $user->delete();
        $this->tenantUserOfFleetAdmin($request, 'delete');
    }
    
    public function getUserByEmail($email)
    {
        return User::where('email',$email)->first();
    }

    public function saveUserDetail($request, $id){
        $type = $request->get('type');
        $tenantId = $request->header('tenantId');
        switch ($type) {
            case 'basic':
                return $this->saveUserBasicInfo($request, $id);
            break;
            case 'user_management':
                $user = $this->getUser($id);
                $user->can_login = $request->enable == 'true' ? 1 : 0;
                $user->save();
                return $this->getUserData($id, NULL, $tenantId);
            break;
            case 'contact':
                return $this->saveUserContactInfo($request, $id);
            break;
            case 'personal':
                return $this->saveUserPersonalInfo($request, $id);
            break;
            case 'password':
                return $this->saveUserPassword($request, $id);
            break;
            
            default:
                # code...
                break;
        }
        
    }

    private function getUserDetailsObject($id, $data = TRUE){
        $userDetail = UsersDetail::where('user_id', $id)->first();
        if(!$userDetail && !$data){
            $userDetail = new UsersDetail();
            $userDetail->user_id = $id;
        }
        return $userDetail;
    }

    private function saveUserBasicInfo($request, $id){

        $tenantId = $request->header('tenantId');
        if (!$user = $this->getUser($id)) {
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->remember_token =  Str::random(10);
        if($user->save()){
            $userDetail = $this->getUserDetailsObject($user->id, FALSE);
            if($tenantId != 'fleet_admin'){
                $userDetail->employee = ($request->employee == 'true' ? 1 : 0);
                $userDetail->operator = ($request->operator == 'true' ? 1 : 0);
            }
            if ($request->image) {
                $userDetail->image = $this->fileuploadExtra($request, 'image');
            }
            if($userDetail->save()){
                $this->tenantUserOfFleetAdmin($request, 'add-update');
                return $this->getUserData($user->id, NULL, $tenantId);
            }
            return false;
        }
        return false;
    }

    private function saveUserContactInfo($request, $id){
        $tenantId = $request->header('tenantId');
        $userDetail = $this->getUserDetailsObject($id, FALSE);
        $userDetail->mobile = $request->mobile;
        $userDetail->address1 = $request->address1;
        $userDetail->address2 = $request->address2;
        $userDetail->city = $request->city;
        $userDetail->state = $request->state;
        $userDetail->postal_code = $request->postal_code;
        $userDetail->country = $request->country;
        if($userDetail->save()){
            return $this->getUserData($id, NULL, $tenantId);
        }
        return false;
    }

    private function saveUserPersonalInfo($request, $id){
        $tenantId = $request->header('tenantId');
        $userDetail = $this->getUserDetailsObject($id, FALSE);
        $userDetail->job_title = $request->job_title;
        $userDetail->dob = $request->dob;
        $userDetail->employee_number = ($request->number ? $request->number : null);
        $userDetail->employee_join_at = ($request->start_date ? $request->start_date : null);
        $userDetail->employee_leave_at = ($request->leave_date ? $request->leave_date : null);
        $userDetail->operator_license_number = ($request->license_number ? $request->license_number : null);
        $userDetail->operator_license_class = ($request->license_class ? $request->license_class : null);
        $userDetail->operator_license_state = ($request->license_state ? $request->license_state : null);
        $userDetail->labor_rate = $request->labour_rate;
        if($userDetail->save()){
            return $this->getUserData($id, NULL, $tenantId);
        }
        return false;
        
    }

    private function saveUserPassword($request, $id){
        $tenantId = $request->header('tenantId');
        if (!$user = $this->getUser($id)) {
            return false;
        }
        $user->password = Hash::make($request->get('password'));        
        if($user->save()){
            $request->merge(['email' => $user->email]);
            $this->tenantUserOfFleetAdmin($request, 'add-update', $request->get('password'));
            return $this->getUserData($id, NULL, $tenantId);
        }
        return false;
    }

    private function tenantUserOfFleetAdmin($request, $action = 'add-update', $password = FALSE){
        $tenant_uid = $request->header('tenantId');
        $email = $request->get('email');
        $tanatManagement = TenantMgmt::with('tenant_users')->where('uid',$tenant_uid)->first();
        if($tanatManagement && $tanatManagement->tenant_password) { $tanatManagement->tenant_password = ''; $tanatManagement->save(); }
        $tenantUserData = '';
        foreach ($tanatManagement->tenant_users as $key => $value) {
            if($email == $value->email){
                $tenantUserData = $value;
            }
        }
        if($action == 'delete'){
            $tanantUser = TanantUser::find($tenantUserData->id);
            $tanantUser->delete();
        }else{
            if($tenantUserData){
                $tanantUser = TanantUser::find($tenantUserData->id);
            }else{
                $tanantUser = new TanantUser();
                $tanantUser->tenant_id = $tanatManagement->id;
            }
            if($password) { $tanantUser->password = $password; }
            $tanantUser->email = $email;
            $tanantUser->save();
        }
    }

    public function getUserData($id = NULL, $email = NULL, $tenantId = NULL){
        $user = '';
        if($id){
            $user = User::with('user_detail')->where('id', $id)->first();
        }elseif($email){
            $user = User::with('user_detail')->where('email', $email)->first();
        }
        $companyData = $plan = [];
        if($tenantId != 'fleet_admin' && $tenantId){
            $companyDetail = SiteDetails::with('plan')->first();
            $orderCount = Payment::where('tenant_id', $companyDetail->tenant_id)->count();
            if($companyDetail){
                $companyData = [
                    'tenant_id' => $companyDetail->tenant_id,
                    'name' => $companyDetail->company_name,
                    'tagline' => $companyDetail->tagline,
                    'mobile' => $companyDetail->tenant_number,
                    'fleet_size' => $companyDetail->fleet_size,
                    'industry' => $companyDetail->industry,
                    'time_zone' => $companyDetail->time_zone,
                    'currency' => $companyDetail->currency,
                    'plan_id' => $companyDetail->plan_id,
                    'free_plan' => ($orderCount > 0 ? false : true),
                    'valid_from' => $companyDetail->valid_from,
                    'valid_till' => $companyDetail->valid_till,
                    'status' => ($companyDetail->is_active == 0 ? false : true),
                    'created_at' => $companyDetail->created_at,
                    'updated_at' => $companyDetail->updated_at,
                ];
                if($companyDetail->plan){
                    $plan = [
                        'id' => $companyDetail->plan->id,
                        'name' => $companyDetail->plan->heading,
                        'free_text' => $companyDetail->plan->description,
                        'price' => $companyDetail->plan->price,
                        'color' => $companyDetail->plan->color,
                        'status' => $companyDetail->plan->status
                    ];
                }
                
            }
        }
        $userDetail = isset($user->user_detail) ? $user->user_detail : null;
        $userId = isset($user->id) ? $user->id : '';
        $employee = ($userDetail && $userDetail->employee ? true : false);
        $data = [
            'id' => $userId,
            'name' => (isset($user->name) ? ucwords($user->name) : ''),
            'email' => (isset($user->email) ? $user->email : ''),
            'admin' => (isset($user->is_admin) ? true : false),
            'basic' => [
                'user_id' => $userId,
                'name' => (isset($user->name) ? $user->name : ''),
                'email' => (isset($user->email) ? $user->email : ''),
                'image' => ($userDetail ? $userDetail->image : ''),
                'employee' => $employee,
                'type' => 'basic'
            ],
            'user_management' => [
                'user_id' => $userId,
                'enable' => (isset($user->can_login) && $user->can_login ? true : false),
                'type' => 'user_management'
            ],
            'contact' => [
                'user_id' => $userId,
                'mobile' => ($userDetail && $userDetail->mobile ? $userDetail->mobile : ''),
                'address1' => ($userDetail && $userDetail->address1 ? $userDetail->address1 : ''),
                'address2' => ($userDetail && $userDetail->address2 ? $userDetail->address2 : ''),
                'city' => ($userDetail && $userDetail->city ? $userDetail->city : ''),
                'state' => ($userDetail && $userDetail->state ? $userDetail->state : ''),
                'postal_code' => ($userDetail && $userDetail->postal_code ? $userDetail->postal_code : ''),
                'country' => ($userDetail && $userDetail->country ? $userDetail->country : ''),
                'type' => 'contact'
            ],
            'personal' => [
                'user_id' => $userId,
                'job_title' => ($userDetail && $userDetail->job_title ? $userDetail->job_title : ''),
                'dob' => ($userDetail && $userDetail->dob ? $userDetail->dob : ''),
                'is_employee' => $employee,
                'employee' => [
                    'number' => ($userDetail && $userDetail->employee_number ? $userDetail->employee_number : ''),
                    'start_date' => ($userDetail && $userDetail->employee_join_at ? $userDetail->employee_join_at : ''),
                    'leave_date' => ($userDetail && $userDetail->employee_leave_at ? $userDetail->employee_leave_at : ''),
                ],
                'type' => 'personal'
            ]
        ];
        
        if($tenantId && $tenantId != 'fleet_admin'){
            $operator = (isset($userDetail->operator) && $userDetail->operator ? true : false);
            $data['basic']['operator'] = $operator;
            $data['personal']['is_operator'] = $operator;
            $data['personal']['operator'] = [
                'license_number' => ($userDetail && $userDetail->operator_license_number ? $userDetail->operator_license_number : ''),
                'license_class' => ($userDetail && $userDetail->operator_license_class ? $userDetail->operator_license_class : ''),
                'license_state' => ($userDetail && $userDetail->operator_license_state ? $userDetail->operator_license_state : '')
            ];
            $data['personal']['labour_rate'] = ($userDetail && $userDetail->labor_rate ? $userDetail->labor_rate : '');
        }
        if($companyData){
            $data['company'] = $companyData;
        }
        if($plan){
            $data['plan'] = $plan;
        }
        return $data;
    }
}
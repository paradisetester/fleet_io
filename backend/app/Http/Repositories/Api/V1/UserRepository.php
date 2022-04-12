<?php

namespace App\Http\Repositories\Api\V1;

use App\Models\User;

class UserRepository implements \App\Http\Repositories\Api\V1\UserRepositoryInterface{

    public function getByEmail($email) {
        // return User::whereEmail($email)
        //                 ->first();
        return $this->getUserDetailByEmail($email);
    }
    
    private function getUserDetailByEmail($email){
        $user = User::with('user_detail')->where('email', $email)->first();
        $userDetail = isset($user->user_detail) ? $user->user_detail : null;
        $userId = isset($user->id) ? $user->id : '';
        return [
            'id' => $userId,
            'basic' => [
                'user_id' => $userId,
                'name' => (isset($user->name) ? $user->name : ''),
                'email' => (isset($user->email) ? $user->email : ''),
                'employee' => ($userDetail && $userDetail->employee ? true : false),
                'operator' => ($userDetail && $userDetail->operator ? true : false),
                'image' => ($userDetail ? $userDetail->image : ''),
                'type' => 'basic'
            ],
            'user_management' => [
                'user_id' => $userId,
                'enable' => (isset($user->can_login) && $user->can_login ? true : false),
                'type' => 'user_management'
            ],
            'contact' => [
                'user_id' => $userId,
                'mobile' => ($userDetail ? $userDetail->mobile : ''),
                'address1' => ($userDetail ? $userDetail->address1 : ''),
                'address2' => ($userDetail ? $userDetail->address2 : ''),
                'city' => ($userDetail ? $userDetail->city : ''),
                'state' => ($userDetail ? $userDetail->state : ''),
                'postal_code' => ($userDetail ? $userDetail->postal_code : ''),
                'country' => ($userDetail ? $userDetail->country : ''),
                'type' => 'contact'
            ],
            'personal' => [
                'user_id' => $userId,
                'job_title' => ($userDetail ? $userDetail->job_title : ''),
                'dob' => ($userDetail ? $userDetail->dob : ''),
                'employee' => ($userDetail && $userDetail->employee ? true : false),
                'operator' => ($userDetail && $userDetail->operator ? true : false),
                'employee' => [
                    'number' => ($userDetail ? $userDetail->employee_number : ''),
                    'start_date' => ($userDetail ? $userDetail->employee_join_at : ''),
                    'leave_date' => ($userDetail ? $userDetail->employee_leave_at : ''),
                ],
                'operator' => [
                    'license_number' => ($userDetail ? $userDetail->operator_license_number : ''),
                    'license_class' => ($userDetail ? $userDetail->operator_license_class : ''),
                    'license_state' => ($userDetail ? $userDetail->operator_license_state : '')
                ],
                'labour_rate' => ($userDetail ? $userDetail->labor_rate : ''),
                'type' => 'personal'
            ]
        ];
    }

}

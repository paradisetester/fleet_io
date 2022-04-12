<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest {

    public function rules() {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    //override this method in your FormRequest
    protected function failedValidation(Validator $validator) {
        $validation_errors = json_decode(json_encode($validator->errors()), true);

        $return = [
            "status" => "error", /* 1 : success, 2 : error */
            "data" => null,
            "errors" => $validation_errors,
            "message" => $this->message
        ];


        throw new HttpResponseException(response()->json($return, 422));
    }

}

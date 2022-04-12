<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AbstractResourceStatus;

class AuthResource extends AbstractResourceStatus {

    public function toArray($request) {

        if ((int) $this->status == 1) {
            if (!empty($this->data->user)) {
                return [
                    "status" => "success", /* 1 : success, 2 : error */
                    "data" => [
                        "access_tokens" => $this->data->access_token,
                        "refresh_token" => $this->data->refresh_token,
                        "user" => $this->data->user
                    ],
                    "message" => $this->message
                ];
            } else {
                return [
                    "status" => "success", /* 1 : success, 2 : error */
                    "data" => [
                        "access_tokens" => $this->data->access_token,
                        "refresh_token" => $this->data->refresh_token
                    ],
                    "message" => $this->message
                ];
            }
        } else {
            return [
                "status" => "error", /* 1 : success, 2 : error */
                "data" => null,
                "message" => $this->message,
                "errors" => []
            ];
        }
    }

}

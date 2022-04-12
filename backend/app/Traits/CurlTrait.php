<?php

namespace App\Traits;

trait CurlTrait {

    pubic function sendRequest($request){

        $refreshToken = $request->get('refresh_token');
       $url = 'http://fleet.localhost/api/v1/tenants';
        
        $tenant_id = $data['tenant_id'];
        $api_request_url = url("/oauth/token");
        
        $client = new \GuzzleHttp\Client();
   
        
        try {
            $response = $client->request('POST', $api_request_url, [
                'form_params' => $data,
                'headers' => ['tenantId' => $tenant_id]
            ]);
            
            
        } catch (\GuzzleHttp\Exception\RequestException $e) {

            return [
                "status" => 2,
                "data" => null,
                "message" => "Client authentication failed.",
                "status_code" => 200
            ];
        }
    } 

}
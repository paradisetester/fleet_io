<?php

namespace App\Http\Proxies\Api\V1;

use Illuminate\Foundation\Application;
use Infrastructure\Auth\Exceptions\InvalidCredentialsException;
use App\Traits\{
    UserTrait
};

class AuthProxy {
    use UserTrait;

    const REFRESH_TOKEN = 'refreshToken';

    private $auth;
    private $db;
    private $request;
    private $userRepository;

    public function __construct(Application $app, \App\Http\Repositories\Api\V1\UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
        $this->auth = $app->make('auth');
        $this->db = $app->make('db');
        $this->request = $app->make('request');
    }

    /**
     * Attempt to create an access token using user credentials
     *
     * @param string $email
     * @param string $password
     */
    public function attemptLogin($email, $password, $tenant_id) {

        $return = [
            "status" => 2, /* 1 : success, 2 : error */
            "data" => null,
            "message" => "Username or password is wrong.",
            "status_code" => 200
        ];

        $user = $this->getUserData('', $email, $tenant_id);
        if(isset($user['company']['status']) && !$user['company']['status']){
            $return['message'] = 'Your account is deactivated!';
        }elseif(isset($user['user_management']['enable']) && !$user['user_management']['enable'] && $tenant_id != 'fleet_admin'){
            $return['message'] = 'Sorry! You don\'t have a access to login';
        }elseif (!is_null($user)) {
            $return = $this->proxy('password', [
                'username' => $email,
                'password' => $password,
                'tenant_id' => $tenant_id
            ]);

            if (isset($return['data'])) {
                $return['data']['user'] = $user;
            }
        }

        return $return;
    }

    /**
     * Attempt to refresh the access token used a refresh token that 
     * has been saved in a cookie
     */
    public function attemptRefresh($refreshToken) {
        return $this->proxy('refresh_token', [
                    'refresh_token' => $refreshToken
        ]);
    }

    /**
     * Proxy a request to the OAuth server.
     * @param string $grantType what type of grant type should be proxied
     * @param array $data the data to send to the server
     */
    public function proxy($grantType, array $data = []) {

        $return = [
            "status" => 2, /* 1 : success, 2 : error */
            "data" => null,
            "message" => "Access Denied.",
            "status_code" => 200
        ];
        
        $data = array_merge($data, [
            'client_id' => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type' => 'password'
        ]);
        
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
                "message" => "Invalid Credentails",
                "status_code" => 200
            ];
        }

        $response->getStatusCode();
        $response->getHeaderLine('content-type');
        $status_code = $response->getStatusCode();
        $body = $response->getBody();
        $content = $body->read(2048);
        $data = json_decode($content);

        if ($status_code == 200) {
            $content = $body->read(2048);
            return [
                "status" => 1,
                "data" => [
                    'access_token' => $data->access_token,
                    'refresh_token' => $data->refresh_token,
                    'expires_in' => $data->expires_in,
                    'tenant_id' => $tenant_id
                ],
                "message" => "Successfull Access.",
                "status_code" => 200
            ];
        }

        return $return;
    }

    /**
     * Logs out the user. We revoke access token and refresh token. 
     * Also instruct the client to forget the refresh cookie.
     */
    public function logout() {
        $accessToken = $this->auth->user()->token();
        $refreshToken = $this->db
                ->table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
            'revoked' => true
        ]);

        $accessToken->revoke();
    }

}

<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class AbstractResourceStatus extends JsonResource {
    
    /**
     *
     * @var null
     */
    public static $wrap = null;

    /**
     * The default status code.
     * 
     * @var int
     */
    protected $statusCode = 200;
    
    /**
     * 
     * @param int $code
     * @return $this
     */
    public function setStatusCode(int $code) {
        $this->statusCode = $code;
        return $this;
    }
    
    /**
     * Changes response structure
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     */
    public function withResponse($request, $response) {
        parent::withResponse($request, $response);
        $response->setStatusCode($this->statusCode);
    }
    
}

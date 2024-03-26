<?php

namespace App\Models;

class JwtResponse extends JsonResponse {
    public $token;

    public $type = 'bearer';

    public $expiration;

    public function __construct($token, $expiration)
    {
        $this->status = ResponseType::Success;
        $this->token = $token;
        $this->expiration = $expiration;
    }
}

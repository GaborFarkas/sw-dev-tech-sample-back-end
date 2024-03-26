<?php

namespace App\Models;

/**
 * A response model containing a JWT token with an expiration time.
 */
class JwtResponse extends JsonResponse {
    /**
     * The JWT token.
     * @var string
     */
    public $access_token;

    /**
     * The token's type (always bearer).
     * @var string
     */
    public $token_type = 'bearer';

    /**
     * The token's expiration in seconds.
     * @var int
     */
    public $expires_in;

    /**
     * @param string $token The JWT token.
     * @param int $expiration The expiration time.
     */
    public function __construct($token, $expiration)
    {
        $this->status = ResponseType::Success;
        $this->access_token = $token;
        $this->expires_in = $expiration;
    }
}

<?php

namespace App\Models;

/**
 * Reponse model with user data.
 */
class UserResponse extends JsonResponse {
    /**
     * User's name
     * @var string
     */
    public $name;

    /**
     * User's email address
     */
    public $email;

    /**
     * @param User $user
     */
    public function __construct($user)
    {
        $this->status = ResponseType::Success;
        $this->name = $user->name;
        $this->email = $user->email;
    }
}

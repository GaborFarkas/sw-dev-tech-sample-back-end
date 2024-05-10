<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * There is a built-in user.
     */
    public function test_there_is_built_in_user(): void
    {
        $this->seed();

        $user = User::where('id', 1)->first();

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * User role mappings are accessible from the user model.
     */
    public function test_user_role_mappings_accessible(): void
    {
        $this->seed();

        $user = User::where('id', 1)->first();
        $roleMappings = $user->roles()->get();

        $this->assertInstanceOf(Collection::class, $roleMappings);
    }

    /**
     * User roles are accessible from the user model.
     */
    public function test_user_roles_accessible(): void
    {
        $this->seed();

        $user = User::where('id', 1)->first();
        $roleMapping = $user->roles()->first();
        $role = $roleMapping->role()->first();

        $this->assertInstanceOf(Role::class, $role);
    }
}

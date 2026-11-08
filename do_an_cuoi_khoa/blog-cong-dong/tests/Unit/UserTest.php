<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_is_admin_returns_true_for_admin_role()
    {
        $user = new User(['role' => 'admin']);
        $this->assertTrue($user->isAdmin());
    }

    public function test_is_admin_returns_false_for_member_role()
    {
        $user = new User(['role' => 'member']);
        $this->assertFalse($user->isAdmin());
    }
}
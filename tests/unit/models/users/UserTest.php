<?php

namespace Tests\Unit\Models\User;

use PHPUnit\Framework\TestCase;
use App\Models\User\User;
use InvalidArgumentException;

class UserTest extends TestCase
{
    public function testShouldThrowWhenNameIsBlank() : void
    {
        $this->expectException(InvalidArgumentException::class);
        User::register(null, ' ', 'test@email.com', 'hash_password_123');
    }
}

?>

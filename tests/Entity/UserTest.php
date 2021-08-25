<?php

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Task;

class UserTest extends TestCase
{
    public function testuserRelatedToTask(){
        $user = new User();
        $user->setUsername('test');
        $user->setPassword('test');
        $user->setEmail('test@test.test');

        $task = new Task();
        $task->setTitle('test');
        $task->setContent('test');
        $task->setUser($user);

        $this->assertSame($user, $task->getUser());
    }
}

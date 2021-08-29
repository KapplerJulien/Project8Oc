<?php

namespace App\Tests\Form\Type;

use App\Form\UserType;
use App\Entity\User;
use App\Entity\Task;
use Symfony\Component\Form\Test\TypeTestCase;

class UserTypeTest extends TypeTestCase
{
    public function testSubmitValidDataUserType()
    {
        $role = ['ROLE_USER'];
        $task = new Task();
        
        $formData = [
            'username' => 'test',
            'password' => array('first' => 'test2', 'second' => 'test2'),
            'email' => 'test@test.test',
            'roles' => $role
        ];

        $model = new User();
        $form = $this->factory->create(UserType::class, $model);

        $expected = new User();
        $expected->setUsername('test');
        $expected->setPassword('test2');
        $expected->setEmail('test@test.test');

        $expected->addTask($task);
        $model->addTask($task);

        $expected->setRoles($role);
        $model->setRoles($role);

        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        // check that $formData was modified as expected when the form was submitted
        $this->assertEquals($expected, $model);
        $this->assertEquals($expected->getTasks(), $model->getTasks());
        $this->assertEquals($expected->getSalt(), $model->getSalt());
        $this->assertEquals($expected->getId(), $model->getId());
    }
}
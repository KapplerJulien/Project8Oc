<?php

namespace App\Tests\Form\Type;

use App\Form\TaskType;
use App\Entity\Task;
use Symfony\Component\Form\Test\TypeTestCase;

class TaskTypeTest extends TypeTestCase
{
    public function testSubmitValidDataTaskType()
    {
        $formData = [
            'title' => 'test',
            'content' => 'test2',
        ];

        $model = new Task();
        $form = $this->factory->create(TaskType::class, $model);

        $expected = new Task();
        $expected->setTitle('test');
        $expected->setContent('test2');
        $expected->setIsDone(false);
        $expected->setCreatedAt(new \DateTime());

        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        $model->setCreatedAt(new \DateTime());

        // check that $formData was modified as expected when the form was submitted
        $this->assertEquals($expected->getTitle(), $model->getTitle());
        $this->assertEquals($expected->getIsDone(), $model->getIsDone());
        $this->assertEquals($expected->getID(), $model->getID());
        $this->assertNotEquals($expected->getCreatedAt(), $model->getCreatedAt());
    }
}

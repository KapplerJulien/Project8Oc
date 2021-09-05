<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $plainPassword = 'test';

        $user = new User();
        $user->setUsername('user');
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $user->setEmail('user@test.com');

        $admin = new User();
        $admin->setUsername('admin');
        $encoded = $this->encoder->encodePassword($admin, $plainPassword);
        $admin->setPassword($encoded);
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setEmail('admin@test.com');

        $manager->persist($user);
        $manager->persist($admin);

        for($i=0; $i < 2; $i++){
            $task = new Task();
            $task->setTitle('task user n°'.(string)$i);
            $task->setContent('Content task user n°'.(string)$i);
            $task->setUser($user);

            $manager->persist($task);
        } 

        for($i=0; $i < 2; $i++){
            $task = new Task();
            $task->setTitle('task admin n°'.(string)$i );
            $task->setContent('Content task admin n°'.(string)$i);
            $task->setUser($admin);

            $manager->persist($task);
        }

        $manager->flush();
    }
}

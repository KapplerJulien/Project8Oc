<?php

namespace App\Tests\Controller;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use App\Entity\User;

class TaskControllerTest extends WebTestCase
{
    protected function createAuthorizedClient($user)
    {
        $client = static::createClient();
        $container = static::$kernel->getContainer();
        $session = $container->get('session');
        $person = self::$kernel->getContainer()->get('doctrine')->getRepository(User::class)->findOneByUsername($user);

        $token = new UsernamePasswordToken($person, null, 'main', $person->getRoles());
        $session->set('_security_main', serialize($token));
        $session->save();

        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));

        return $client;
    }

    public function testCreateTask(): void
    {
        $client = $this->createAuthorizedClient('test3');

        $crawler = $client->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form([
            'task[title]' => 'titldzadae2',
            'task[content]' => 'cntdaznreater2'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/tasks');
    }

    public function testEditTask(): void
    {
        $client = $this->createAuthorizedClient('test3');

        $crawler = $client->request('GET', '/tasks/34/edit');
        $form = $crawler->selectButton('Modifier')->form([
            'task[title]' => 'test tidzadaatle2',
            'task[content]' => 'contedzadzaant2'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/tasks');
    }

    public function testDeleteTask(): void
    {
        $client = $this->createAuthorizedClient('test5');

        $crawler = $client->request('GET', '/tasks/54/delete');
        $this->assertResponseRedirects('/tasks');
    }

    public function testDeleteTaskWithWrongUser(): void
    {
        $client = $this->createAuthorizedClient('test4');
        $crawler = $client->request('GET', '/tasks/55/delete');
        $this->assertResponseRedirects('/tasks');
    }
}
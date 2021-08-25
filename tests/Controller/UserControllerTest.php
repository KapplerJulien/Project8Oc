<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
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

    public function testCreateUser(): void
    {
        $client = $this->createAuthorizedClient('test5');
        $role = ['ROLE_ADMIN'];

        $crawler = $client->request('GET', '/users/create');
        $form = $crawler->selectButton('Ajouter')->form([
            'user[username]' => 'gezrzfe',
            'user[password]' => array('first' => 'test2', 'second' => 'test2'),
            'user[email]' => 'ge45@test.test',
            'user[roles]' => $role
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/users');
    }

    public function testEditUser(): void
    {
        $client = $this->createAuthorizedClient('test3');
        $role = ['ROLE_ADMIN'];

        $crawler = $client->request('GET', '/users/5/edit');
        $form = $crawler->selectButton('Modifier')->form( [
            'user[username]' => 'ht5geg',
            'user[password]' => array('first' => 'test', 'second' => 'test'),
            'user[email]' => 'tess@test.test',
            'user[roles]' => $role
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/users');
    }
}
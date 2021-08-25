<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginWithBadCredentials()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form([
            'username' => 'test',
            'password' => 'fakePassword'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects();
    }

    public function testLoginWithCorrectCredentials()
    {
        $client = static::createClient();
        $csrfToken = $client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');
        $crawler = $client->request('POST', '/login', [
            '_csrf_token' => $csrfToken,
            'username' => 'test3',
            'password' => 'test2'
        ]);
        $this->assertResponseRedirects('/');
    }
}

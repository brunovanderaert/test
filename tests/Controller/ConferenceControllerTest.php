<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;

class ConferenceControllerTest extends WebTestCase
{
    // public function testSomething()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/');

    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('h1', 'Hello World');
    // }
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testCommentSubmission() 
    {
        $client = static::createClient();
        $client->request('GET', '/conference/amsterdam-2019');
        $client->submitForm('Submit', [
            'comment_form[author]' => 'Fabien',
            'comment_form[text]' => 'Some feed backfrom an automated functional test',
            'comment_form[email]' => $email = 'me@automat.ed',
            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
        ]);
        $this->assertResponseRedirects();

        // simulate comment validation
        $comment = self::$container->get(CommentRepository::class)->findOneByEmail($email);
        $comment->setState('published');
        self::$container->get(EntityManagerInterface::class)->flush();

        $client->followRedirect();
        //$this->assertSelectorExists('div:contains("There are 2 comments")'); 
    }

    public function testConferencePage() 
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h4'));

        $client->clickLink('View');

        $this->assertPageTitleContains('Amsterdam');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Amsterdam 2019');
        //$this->assertSelectorExists('div:contains("There are 1 comments")');
    }

    /* email admin tests
    public function testMailerAssertions()
    {
        $client = static::createClient(); $client->request('GET', '/');
        $this->assertEmailCount(1);
        $event = $this->getMailerEvent(0); $this->assertEmailIsQueued($event);
        $email = $this->getMailerMessage(0); $this->assertEmailHeaderSame($email, 'To', 'bruno.vanderaert@gmail.com');
        $this->assertEmailTextBodyContains($email, 'Bar');
        var_dump($email); 
        $this->assertEmailAttachmentCount($email, 1);
    }
    */
}

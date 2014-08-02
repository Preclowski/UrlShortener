<?php

namespace Clearcode\UrlerBundle\Test\Controller;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;

/**
 * @group UrlControllerTest
 */
class UrlControllerTest extends WebTestCase
{
    protected static $client;
    protected static $application;

    public function setUp()
    {
        parent::setUp();

        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:update --force');
        self::runCommand('doctrine:fixtures:load --purge-with-truncate --append');
    }

    public function testIndex()
    {
        $crawler = self::$client->request('GET', '/123456');

        echo $crawler->html();@ob_flush();
    }

    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    protected static function getApplication()
    {
        if (null === self::$application) {
            self::$client = static::createClient();

            self::$application = new Application(self::$client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }
}
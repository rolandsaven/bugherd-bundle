<?php

namespace RolandSaven\BugherdBundle\Tests\DependencyInjection;

use RolandSaven\BugherdBundle\DependencyInjection\BugherdExtension;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * @covers \RolandSaven\BugherdBundle\DependencyInjection\Configuration
 * @covers \RolandSaven\BugherdBundle\DependencyInjection\HileniumStyleExtension
 */
class BugherdExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testUserLoadThrowsExceptionUnlessDriverIsValid()
    {
        $loader = new BugherdExtension();
        $config = array('key' => 'foo');
        $loader->load(array($config), new ContainerBuilder());
    }

    public function testConfig()
    {
        $this->createFullConfiguration();

        $this->assertParameter('foo_key', 'bugherd_api_key');

        $this->assertContains('bugherd', $this->containerBuilder->getServiceIds());}

    /**
     * @return ContainerBuilder
     */
    protected function createFullConfiguration()
    {
        $this->containerBuilder = new ContainerBuilder();
        $loader = new BugherdExtension();
        $loader->load(array($this->getFullConfig()), $this->containerBuilder);
        $this->assertTrue($this->containerBuilder instanceof ContainerBuilder);
    }

    protected function getFullConfig()
    {
        $yaml = <<<EOF
api_key: 'foo_key'
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    private function assertParameter($value, $key)
    {
        $this->assertEquals($value, $this->containerBuilder->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    protected function tearDown()
    {
        unset($this->containerBuilder);
    }
}
<?php
namespace RolandSaven\BugherdBundle\Tests\DependencyInjection;
/**
 * @covers \RolandSaven\BugherdBundle\DependencyInjection\Configuration
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsConfigurationInterface()
    {
        $rc = new \ReflectionClass('RolandSaven\BugherdBundle\DependencyInjection\Configuration');
        $this->assertTrue($rc->implementsInterface('Symfony\Component\Config\Definition\ConfigurationInterface'));
    }
}
<?php

namespace MDurys\GupekBundle\Tests\Logic;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class LogicTestCase extends KernelTestCase
{
    private $containter;

    public function setUp()
    {
        self::bootKernel();
        $this->container = static::$kernel->getContainer();
    }

    protected function getContainer()
    {
        return $this->container;
    }
}

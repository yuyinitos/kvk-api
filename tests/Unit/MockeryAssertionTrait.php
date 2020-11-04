<?php

declare(strict_types=1);


namespace Yuyinitos\KvkApi\Test\Unit;

use Mockery;

trait MockeryAssertionTrait
{
    public function setUp(): void
    {
        parent::setUp();
        Mockery::resetContainer();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }
        Mockery::close();
    }

    abstract public function addToAssertionCount($count);
}

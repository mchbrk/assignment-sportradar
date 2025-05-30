<?php
declare(strict_types=1);

namespace Tests;

use Faker\Factory;
use Faker\Generator;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }
}

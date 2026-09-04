<?php

declare(strict_types=1);

namespace BEAR\QATools\Smoke;

use PHPUnit\Framework\TestCase;

class GreeterTest extends TestCase
{
    public function testGreetUsesDefaultGreeting(): void
    {
        $greeter = new Greeter();

        $this->assertSame('Hello, World', $greeter->greet('World'));
    }

    public function testGreetUsesCustomGreeting(): void
    {
        $greeter = new Greeter('Hi');

        $this->assertSame('Hi, World', $greeter->greet('World'));
    }
}

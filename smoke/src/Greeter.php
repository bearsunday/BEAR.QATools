<?php

declare(strict_types=1);

namespace BEAR\QATools\Smoke;

use function sprintf;

final class Greeter
{
    public function __construct(private readonly string $greeting = 'Hello')
    {
    }

    public function greet(string $name): string
    {
        return sprintf('%s, %s', $this->greeting, $name);
    }
}

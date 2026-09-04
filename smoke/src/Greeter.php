<?php

declare(strict_types=1);

namespace BEAR\QATools\Smoke;

use function sprintf;

final class Greeter
{
    /** @var string */
    private $greeting;

    public function __construct(string $greeting = 'Hello')
    {
        $this->greeting = $greeting;
    }

    public function greet(string $name): string
    {
        return sprintf('%s, %s', $this->greeting, $name);
    }
}

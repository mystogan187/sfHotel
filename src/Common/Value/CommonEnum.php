<?php

declare(strict_types=1);

namespace App\Common\Value;

use JetBrains\PhpStorm\Pure;
use MyCLabs\Enum\Enum;

class CommonEnum extends Enum
{
    public function __construct($value)
    {
        parent::__construct($value);
    }

    #[Pure]
    public function value(): string
    {
        return $this->getValue();
    }
}

<?php

declare(strict_types=1);

namespace App\Entity\Guest\Exception;

use App\Exception\Interfaces\NotFoundException;
use Exception;
use Throwable;

class GuestNotFoundException extends Exception implements NotFoundException
{
    public function __construct($value = 0, int $code = 0, Throwable $previous = null) {
        parent::__construct("Guest with ID: '{$value}' not found", $code, $previous);
    }
}

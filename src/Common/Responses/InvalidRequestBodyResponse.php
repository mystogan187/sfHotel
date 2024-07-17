<?php

declare(strict_types=1);

namespace App\Common\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InvalidRequestBodyResponse extends JsonResponse
{
    public const RESPONSE = 'Invalid request body';

    public function __construct()
    {
        parent::__construct(['error' => self::RESPONSE], Response::HTTP_BAD_REQUEST);
    }
}
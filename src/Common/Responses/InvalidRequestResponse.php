<?php

declare(strict_types=1);

namespace App\Common\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InvalidRequestResponse extends JsonResponse
{
    public const RESPONSE = "Invalid request parameters";

    public function __construct(string $msg = null)
    {
        parent::__construct(['error' => $msg ?? self::RESPONSE], Response::HTTP_BAD_REQUEST);
    }
}

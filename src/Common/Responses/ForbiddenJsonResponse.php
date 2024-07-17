<?php

declare(strict_types=1);

namespace App\Common\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenJsonResponse extends JsonResponse
{
    public function __construct(string $message)
    {
        parent::__construct(['error' => $message], Response::HTTP_FORBIDDEN);
    }
}
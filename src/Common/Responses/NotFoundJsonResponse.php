<?php

declare(strict_types=1);

namespace App\Common\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotFoundJsonResponse extends JsonResponse
{
    public function __construct($data = null)
    {
        parent::__construct(['error' => $data ?? 'Resource not found'], Response::HTTP_NOT_FOUND);
    }
}

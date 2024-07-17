<?php

declare(strict_types=1);

namespace App\Common\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(
            ['error' => 'Internal server error'],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}

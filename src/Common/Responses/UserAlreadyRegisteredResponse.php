<?php

declare(strict_types=1);

namespace App\Common\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserAlreadyRegisteredResponse
{
    public function __invoke(): JsonResponse {
        return new JsonResponse(
            [
                'error' => 'User already registered',
            ],
            Response::HTTP_NOT_ACCEPTABLE
        );
    }
}

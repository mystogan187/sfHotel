<?php

namespace App\Controller\User;

use App\Common\Responses\InvalidRequestResponse;
use App\Common\Responses\NotFoundJsonResponse;
use App\Service\User\GetUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetUserAction
{
    private GetUserService $service;

    public function __construct(GetUserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        if (!is_numeric($id)) {
            return new InvalidRequestResponse();
        }

        $userDTO = $this->service->__invoke((int) $id);
        if (null === $userDTO) {
            return new NotFoundJsonResponse();
        }

        return new JsonResponse($userDTO->toArray());
    }
}

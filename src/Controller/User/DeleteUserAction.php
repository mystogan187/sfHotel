<?php

namespace App\Controller\User;

use App\Common\Responses\InvalidRequestResponse;
use App\Common\Responses\NotFoundJsonResponse;
use App\Service\User\DeleteUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DeleteUserAction
{
    private DeleteUserService $service;

    public function __construct(DeleteUserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        if (!is_numeric($id)) {
            return new InvalidRequestResponse();
        }

        try {
            $this->service->__invoke((int) $id);
            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (UserNotFoundException $e) {
            return new NotFoundJsonResponse();
        }
    }
}

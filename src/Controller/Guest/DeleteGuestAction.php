<?php

namespace App\Controller\Guest;

use App\Common\Responses\InvalidRequestResponse;
use App\Common\Responses\NotFoundJsonResponse;
use App\Service\Guest\DeleteGuestService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DeleteGuestAction
{
    private DeleteGuestService $service;

    public function __construct(DeleteGuestService $service)
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
        } catch (GuestNotFoundException $e) {
            return new NotFoundJsonResponse();
        }
    }
}

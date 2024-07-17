<?php

namespace App\Controller\Guest;

use App\Common\Responses\InvalidRequestResponse;
use App\Common\Responses\NotFoundJsonResponse;
use App\Entity\Guest\Exception\GuestNotFoundException;
use App\Service\Guest\DTO\GuestDTO;
use App\Service\Guest\GetGuestService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetGuestAction
{
    public function __construct(private GetGuestService $service) {}

    public function __invoke(string $id, Request $request): GuestDTO|JsonResponse
    {
        if (!is_numeric($id)) {
            return new InvalidRequestResponse();
        }

        try {
            return $this->service->__invoke((int) $id);
        } catch (GuestNotFoundException) {
            return new NotFoundJsonResponse();
        }
    }
}

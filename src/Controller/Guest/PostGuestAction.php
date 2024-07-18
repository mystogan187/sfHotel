<?php

namespace App\Controller\Guest;

use App\Service\Guest\CreateGuestService;
use App\Service\Guest\DTO\GuestDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PostGuestAction extends AbstractController
{
    private CreateGuestService $createGuestService;
    private SerializerInterface $serializer;

    public function __construct(CreateGuestService $createGuestService, SerializerInterface $serializer)
    {
        $this->createGuestService = $createGuestService;
        $this->serializer = $serializer;
    }

    #[Route('/guests', name: 'create_guest', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $guestInputDTO = $this->serializer->deserialize($request->getContent(), GuestDTO::class, 'json');
        $guest = $this->createGuestService->createGuest($guestInputDTO);

        return $this->json($guest, Response::HTTP_CREATED);
    }
}

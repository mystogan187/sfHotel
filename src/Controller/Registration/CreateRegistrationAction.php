<?php

namespace App\Controller\Registration;

use App\Entity\Registration\Registration;
use App\Service\Registration\CreateRegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CreateRegistrationAction extends AbstractController
{
    private $registrationService;
    private $serializer;

    public function __construct(CreateRegistrationService $registrationService, SerializerInterface $serializer)
    {
        $this->registrationService = $registrationService;
        $this->serializer = $serializer;
    }

    #[Route('/register', name: 'register_guests', methods: ['POST'])]
    public function register(Request $request): Response
    {
        $data = $request->getContent();
        $registration = $this->serializer->deserialize($data, Registration::class, 'json');

        $this->registrationService->registerGuests($registration);

        return new Response(sprintf('Guests registered with registration id: %d', $registration->getId()), Response::HTTP_CREATED);
    }
}
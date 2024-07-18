<?php

namespace App\Service\Registration;


use App\Entity\Registration\Registration;
use Doctrine\ORM\EntityManagerInterface;

class CreateRegistrationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function registerGuests(Registration $registration): void
    {
        $guests = $registration->getGuests();
        foreach ($guests as $guest) {
            $guest->setRegistration($registration);
            $this->entityManager->persist($guest);
        }

        $this->entityManager->persist($registration);
        $this->entityManager->flush();
    }
}
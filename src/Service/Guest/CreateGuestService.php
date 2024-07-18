<?php

namespace App\Service\Guest;

use App\Entity\Guest\Guest;
use App\Repository\User\UserRepository;
use App\Service\Guest\DTO\GuestDTO;
use Doctrine\ORM\EntityManagerInterface;


class CreateGuestService
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function createGuest(GuestDTO $dto): Guest
    {
        $guest = new Guest();
        $guest->setName($dto->name);
        $guest->setSurname($dto->surname);
        $guest->setDateOfBirth($dto->dateOfBirth);
        $guest->setGender($dto->gender);
        $guest->setPassportNumber($dto->passportNumber);
        $guest->setCountry($dto->country);

        $user = $this->userRepository->find($dto->userWhoRegistered->getId());
        $guest->setUserWhoRegistered($user);

        $this->entityManager->persist($guest);
        $this->entityManager->flush();

        return $guest;
    }
}
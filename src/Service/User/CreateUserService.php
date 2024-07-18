<?php

namespace App\Service\User;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use App\Service\User\DTO\UserDTO;
use App\Service\User\DTO\UserInputDTO;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class CreateUserService
{
    private UserRepository $repository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepository $repository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->repository = $repository;
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(UserInputDTO $inputDTO): UserDTO
    {
        $user = new User();
        $user->setEmail($inputDTO->email);
        $user->setFirstName($inputDTO->firstName);
        $user->setLastName($inputDTO->lastName);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $inputDTO->password);
        $user->setPassword($hashedPassword);

        $this->repository->save($user);

        return new UserDTO(
            $user->getId(),
            $user->getEmail(),
            $user->getFirstName(),
            $user->getLastName()
        );
    }
}

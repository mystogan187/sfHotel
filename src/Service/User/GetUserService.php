<?php

namespace App\Service\User;

use App\Repository\User\UserRepository;
use App\Service\User\DTO\UserDTO;

final class GetUserService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?UserDTO
    {
        $user = $this->repository->find($id);
        if (null === $user) {
            return null;
        }

        return new UserDTO(
            $user->getId(),
            $user->getEmail(),
            $user->getFirstName(),
            $user->getLastName()
        );
    }
}

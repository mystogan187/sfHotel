<?php

namespace App\Service\User;

use App\Repository\User\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

final class DeleteUserService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(int $id): void
    {
        $user = $this->repository->find($id);
        if (null === $user) {
            throw new UserNotFoundException($id);
        }

        $this->repository->remove($user);
    }
}

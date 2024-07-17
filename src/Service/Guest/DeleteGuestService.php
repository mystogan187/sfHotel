<?php

namespace App\Service\Guest;

use App\Entity\Guest\Exception\GuestNotFoundException;
use App\Repository\Guest\GuestRepository;

final class DeleteGuestService
{
    private GuestRepository $repository;

    public function __construct(GuestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws GuestNotFoundException
     */
    public function __invoke(int $id): void
    {
        $guest = $this->repository->find($id);
        if (null === $guest) {
            throw new GuestNotFoundException($id);
        }

        $this->repository->remove($guest);
    }
}

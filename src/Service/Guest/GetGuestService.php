<?php

namespace App\Service\Guest;

use App\Entity\Guest\Exception\GuestNotFoundException;
use App\Repository\Guest\GuestRepository;
use App\Service\Guest\DTO\GuestDTO;
//use Symfony\Component\Security\Core\Security;


final class GetGuestService
{
    public function __construct(
        private GuestRepository $repository,
        //private UserRepository $userRepository,
        //private Security $security,

    ) {
    }

    /**
     * @throws GuestNotFoundException
     */
    public function __invoke(int $id): ?GuestDTO
    {
        $guestDTO = $this->repository->findById(
            $id,
        );

        if (null === $guestDTO) {
            throw new GuestNotFoundException($id);
        }

        return $guestDTO;
    }
}
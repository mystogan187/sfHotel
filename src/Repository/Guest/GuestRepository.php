<?php

namespace App\Repository\Guest;

use App\Entity\Guest\Guest;
use App\Repository\User\UserRepository;
use App\Service\Guest\DTO\GuestDTO;
use App\Service\User\DTO\UserDTO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guest>
 *
 * @method Guest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guest[]    findAll()
 * @method Guest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuestRepository extends ServiceEntityRepository
{
    private $userRepository;

    public function __construct(ManagerRegistry $registry, UserRepository $userRepository)
    {
        parent::__construct($registry, Guest::class);
        $this->userRepository = $userRepository;
    }

    public function findById(int $id): ?GuestDTO
    {
        $guest = $this->find($id);

        if (!$guest) {
            return null;
        }

        $userWhoRegistered = $this->userRepository->find($guest->getUserIdWhoRegistered());

        if (!$userWhoRegistered) {
            return null;
        }

        $userWhoRegisteredDTO = new UserDTO(
            $userWhoRegistered->getId(),
            $userWhoRegistered->getEmail(),
            $userWhoRegistered->getFirstName(),
            $userWhoRegistered->getLastName()
        );

        return new GuestDTO(
            $guest->getId(),
            $guest->getName(),
            $guest->getSurname(),
            $guest->getDateOfBirth(),
            $guest->getGender(),
            $guest->getPassportNumber(),
            $guest->getCountry(),
            $userWhoRegisteredDTO->getId(),
            $guest->getRegistrationId()
        );
    }

    public function save(Guest $guest): void
    {
        $this->_em->persist($guest);
        $this->_em->flush();
    }

    public function remove(Guest $guest): void
    {
        $this->_em->remove($guest);
        $this->_em->flush();
    }
}

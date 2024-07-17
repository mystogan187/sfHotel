<?php

namespace App\Service\Guest\DTO;

use ApiPlatform\Metadata\ApiResource;
use App\Service\User\DTO\UserDTO;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['guest:read']],
    denormalizationContext: ['groups' => ['guest:write']]
)]
final class GuestDTO
{
    public function __construct(
        #[Groups(['guest:read'])]
        public int $id,

        #[Groups(['guest:read', 'guest:write'])]
        public string $name,

        #[Groups(['guest:read', 'guest:write'])]
        public string $surname,

        #[Groups(['guest:read', 'guest:write'])]
        public DateTimeInterface $dateOfBirth,

        #[Groups(['guest:read', 'guest:write'])]
        public string $gender,

        #[Groups(['guest:read', 'guest:write'])]
        public string $passportNumber,

        #[Groups(['guest:read', 'guest:write'])]
        public string $country,

        #[Groups(['guest:read'])]
        public UserDTO $userWhoRegistered,

        #[Groups(['guest:read', 'guest:write'])]
        public int $registrationId
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'date_of_birth' => $this->dateOfBirth->format('Y-m-d'),
            'gender' => $this->gender,
            'passport_number' => $this->passportNumber,
            'country' => $this->country,
            'user_who_registered' => $this->userWhoRegistered->toArray(),
            'registration_id' => $this->registrationId,
        ];
    }
}

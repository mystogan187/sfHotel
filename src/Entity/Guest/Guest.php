<?php

namespace App\Entity\Guest;

use App\Entity\User\User;
use App\Repository\Guest\GuestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: GuestRepository::class)]
#[ORM\Table(name: "guest")]
class Guest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank]
    private string $surname;

    #[ORM\Column(type: "datetime")]
    #[Assert\Date]
    private \DateTimeInterface $dateOfBirth;

    #[ORM\Column(type: "string", length: 1)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ["M", "F", "X"])]
    private string $gender;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 20)]
    private string $passportNumber;

    #[ORM\Column(type: "string", length: 3)]
    #[Assert\NotBlank]
    private string $country;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id_who_registered", referencedColumnName: "id", nullable: false)]
    private User $userWhoRegistered;

    #[ORM\Column(type: "integer", options: ["unsigned" => true])]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\SequenceGenerator(sequenceName: "registration_id_seq", initialValue: 10000)]
    private int $registrationId;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getDateOfBirth(): \DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getPassportNumber(): string
    {
        return $this->passportNumber;
    }

    public function setPassportNumber(string $passportNumber): void
    {
        $this->passportNumber = $passportNumber;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getUserWhoRegistered(): User
    {
        return $this->userWhoRegistered;
    }

    public function setUserWhoRegistered(User $userWhoRegistered): void
    {
        $this->userWhoRegistered = $userWhoRegistered;
    }

    public function getRegistrationId(): int
    {
        return $this->registrationId;
    }

    public function setRegistrationId(int $registrationId): void
    {
        $this->registrationId = $registrationId;
    }
}

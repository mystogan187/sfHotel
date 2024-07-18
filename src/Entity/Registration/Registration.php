<?php

namespace App\Entity\Registration;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\Registration\CreateRegistrationAction;
use App\Entity\Guest\Guest;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity]
#[ORM\Table(name: "registrations")]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/register',
            status: Response::HTTP_CREATED,
            controller: CreateRegistrationAction::class,
            openapiContext: [
                'summary' => 'Register guests',
                'description' => 'Registers a list of guests with check-in and check-out dates.',
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'guests' => [
                                        'type' => 'array',
                                        'items' => [
                                            '$ref' => '#/components/schemas/Guest'
                                        ],
                                        'description' => 'Array of guest objects to be registered'
                                    ],
                                    'checkIn' => [
                                        'type' => 'string',
                                        'format' => 'date-time',
                                        'description' => 'Check-in date and time'
                                    ],
                                    'checkOut' => [
                                        'type' => 'string',
                                        'format' => 'date-time',
                                        'description' => 'Check-out date and time'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'responses' => [
                    '201' => [
                        'description' => 'Guests successfully registered',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'message' => [
                                            'type' => 'string',
                                            'example' => 'Guests registered successfully'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            output: false,
            read: false,
            write: false
        )
    ]
)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Guest::class, mappedBy: "registration", cascade: ["persist"])]
    private Collection $guests;

    #[ORM\Column(type: "datetime")]
    #[Assert\DateTime]
    private DateTimeInterface $checkIn;

    #[ORM\Column(type: "datetime")]
    #[Assert\DateTime]
    private DateTimeInterface $checkOut;

    public function __construct()
    {
        $this->guests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(Guest $guest): void
    {
        if (!$this->guests->contains($guest)) {
            $this->guests[] = $guest;
            $guest->setRegistration($this);
        }
    }

    public function removeGuest(Guest $guest): void
    {
        if ($this->guests->removeElement($guest)) {
            if ($guest->getRegistration() === $this) {
                $guest->setRegistration(null);
            }
        }
    }

    public function getCheckIn(): DateTimeInterface
    {
        return $this->checkIn;
    }

    public function setCheckIn(DateTimeInterface $checkIn): void
    {
        $this->checkIn = $checkIn;
    }

    public function getCheckOut(): DateTimeInterface
    {
        return $this->checkOut;
    }

    public function setCheckOut(DateTimeInterface $checkOut): void
    {
        $this->checkOut = $checkOut;
    }
}

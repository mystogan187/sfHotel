<?php

namespace App\Entity\Login;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Entity\User\User;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'logins')]
#[ApiResource(
    uriTemplate: '/logins',
    operations: [
        new Post(
            uriTemplate: '/login',
            status: 201,
            openapiContext: [
                'summary' => 'User login',
                'description' => 'Authenticates a user and returns a boolean indicating the success of the login.',
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'email' => [
                                        'type' => 'string',
                                        'example' => 'test@example.com',
                                        'description' => 'User email address.'
                                    ],
                                    'password' => [
                                        'type' => 'string',
                                        'example' => 'securepassword',
                                        'description' => 'User password.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'responses' => [
                    '200' => [
                        'description' => 'Successful login',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'message' => [
                                            'type' => 'string',
                                            'example' => 'Login successful'
                                        ],
                                        'success' => [
                                            'type' => 'boolean',
                                            'example' => true
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    '401' => [
                        'description' => 'Unauthorized',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'message' => [
                                            'type' => 'string',
                                            'example' => 'Invalid credentials'
                                        ],
                                        'success' => [
                                            'type' => 'boolean',
                                            'example' => false
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
    ],
    graphQlOperations: []
)]
class Login
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    #[ORM\Column(type: 'integer')]
    private int $loginAttempt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getLoginAttempt(): int
    {
        return $this->loginAttempt;
    }

    public function setLoginAttempt(int $loginAttempt): void
    {
        $this->loginAttempt = $loginAttempt;
    }

    public function getLoginAttemptDateTime(): DateTime
    {
        return (new DateTime())->setTimestamp($this->loginAttempt);
    }

    public function setLoginAttemptDateTime(DateTime $dateTime): void
    {
        $this->loginAttempt = $dateTime->getTimestamp();
    }
}

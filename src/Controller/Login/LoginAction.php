<?php

namespace App\Controller\Login;

use App\Service\Login\LoginAttemptService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class LoginAction extends AbstractController
{
    private $loginAttemptService;
    private $passwordHasher;

    public function __construct(LoginAttemptService $loginAttemptService, UserPasswordHasherInterface $passwordHasher)
    {
        $this->loginAttemptService = $loginAttemptService;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) {
            return new JsonResponse(['message' => 'Email and password are required'], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->loginAttemptService->checkUserCredentials($email, $password);

        if ($user) {
            return new JsonResponse(['message' => 'Login successful'], Response::HTTP_OK);
        }

        return new JsonResponse(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }
}

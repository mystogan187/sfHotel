<?php

namespace App\Controller\User;

use App\Service\User\CreateUserService;
use App\Service\User\DTO\UserInputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserAction
{
    private CreateUserService $service;
    private ValidatorInterface $validator;

    public function __construct(CreateUserService $service, ValidatorInterface $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    #[Route('/api/users', name: 'create_user', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $inputDTO = new UserInputDTO();
        $inputDTO->email = $data['email'] ?? '';
        $inputDTO->firstName = $data['firstName'] ?? '';
        $inputDTO->lastName = $data['lastName'] ?? '';
        $inputDTO->password = $data['password'] ?? '';

        $errors = $this->validator->validate($inputDTO);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $userDTO = $this->service->__invoke($inputDTO);

        return new JsonResponse($userDTO->toArray(), JsonResponse::HTTP_CREATED);
    }
}

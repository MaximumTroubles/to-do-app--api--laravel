<?php

namespace App\Services;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function save(UserDto $dto): User
    {
        return $this->userRepository->save(
            $dto->getName(),
            $dto->getPassword(),
        );
    }

    public function update(UserDto $dto, int $id): User
    {
        return $this->userRepository->update(
            $dto->getName(),
            $dto->getPassword(),
            $id,
        );
    }

    public function show($id): User
    {
        return $this->userRepository->show($id);
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }
}

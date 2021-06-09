<?php

namespace App\Services\Interfaces;

use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getAll(): Collection;

    public function save(UserDto $dto): User;

    public function update(UserDto $dto, int $id): User;

    public function show($id): User;

    public function delete(int $id): void;
}

<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;

    public function save(string $name, string $passwrod): User;

    public function update(string $name, string $password, $id): User;

    public function show($id): User;

    public function delete(int $id): void;
}

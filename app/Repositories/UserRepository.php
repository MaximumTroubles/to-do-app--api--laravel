<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function getAll(): Collection
    {
        return User::with('tasks')->get();
    }

    public function save(string $name, string $passwrod): User
    {
        $user = new User();
        $user->name = $name;
        $user->password = $passwrod;
        $user->save();

        return $user;
    }

    public function update(string $name, string $password, $id): User
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $name,
            'password' => $password,
        ]);

        return $user;
    }

    public function show($id): User
    {
        return User::findOrFail($id);
    }

    public function delete(int $id): void
    {
        User::destroy($id);
    }
}

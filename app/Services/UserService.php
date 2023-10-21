<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    public function query(): Builder
    {
        return User::query();
    }

    public function findOne(?int $id = null, string $usernameOrEmail = ''): ?User
    {
        if(!is_null($id))
        {
            return $this->query()->find($id);
        }
       
        return $this->query()
                    ->withoutTrashed()
                    ->with('userProfile', 'role')
                    ->where('username', $usernameOrEmail)
                    ->orWhere('email', $usernameOrEmail)
                    ->first();
    }
}
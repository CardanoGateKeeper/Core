<?php

namespace App\Services;

use App\Models\User;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * @throws AppException
     * @throws ValidationException
     */
    public function create(array $userData): User
    {
        $validRoles = implode(',', [
            ROLE_ADMIN,
            ROLE_STAFF,
        ]);

        // Simple password rule for local dev environment only
        $passwordRules = app()->environment('local')
            ? Password::min(6)
            : Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
        ;

        $validator = Validator::make(
            $userData,
            [
                'roles.*' => ['required', 'min:1', 'distinct', 'in:' . $validRoles],
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => $passwordRules,
            ],
        );

        if ($validator->fails()) {
            throw new AppException(sprintf(
                'Validation errors: %s',
                implode(' ', $validator->errors()->all())
            ));
        }

        $user = new User;
        $user->fill($validator->validated());
        $user->save();

        return $user;
    }

    public function allUsers(): Collection
    {
        return User::all();
    }
}

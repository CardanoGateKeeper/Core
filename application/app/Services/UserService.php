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
        $validator = Validator::make(
            $userData,
            [
                'roles.*' => ['required', 'min:1', 'distinct', 'in:' . implode(',', validRoles())],
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => $this->passwordRules(),
            ],
        );

        if ($validator->fails()) {
            throw new AppException(sprintf(
                '%s: %s',
                trans('validation errors'),
                implode(' ', $validator->errors()->all())
            ));
        }

        $user = new User;
        $user->fill($validator->validated());
        $user->save();

        return $user;
    }

    public function allUsers(?string $search = null): Collection
    {
        if (!empty($search)) {
            return User::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhereJsonContains('roles', $search)
                ->get();
        }

        return User::all();
    }

    public function findById(int $userId): ?User
    {
        return User::where('id', $userId)
            ->first();
    }

    /**
     * @throws AppException
     * @throws ValidationException
     */
    public function save(array $payload): void
    {
        $user = null;
        if (!empty($payload['user_id']) && !$user = $this->findById($payload['user_id'])) {
            throw new AppException('User not found');
        }

        $validationRules = [
            'roles.*' => ['required', 'distinct', 'in:' . implode(',', validRoles())],
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email' . ($user ? ',' . $user->id : '')],
        ];
        if (!empty($payload['password'])) {
            $validationRules['password'] = $this->passwordRules();
        }

        $validator = Validator::make($payload, $validationRules);

        if ($validator->fails()) {
            throw new AppException(sprintf(
                '%s: %s',
                trans('validation errors'),
                implode(' ', $validator->errors()->all())
            ));
        }

        if (!$user) {
            $user = new User;
        }
        $validPayload = $validator->validated();
        if (!isset($validPayload['roles'])) {
            $validPayload['roles'] = [];
        }
        $user->fill($validPayload);
        $user->save();
    }

    private function passwordRules(): Password
    {
        return app()->environment('local')
            ? Password::min(6) // Simple password rule for local dev environment only
            : Password::min(8) // Complex password rule for all other environments
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
        ;
    }
}

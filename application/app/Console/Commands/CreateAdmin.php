<?php

namespace App\Console\Commands;

use Throwable;
use App\Services\UserService;

class CreateAdmin extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {

            $userData = [
                'roles' => [ ROLE_ADMIN ],
                'name' => $this->ask(trans('Enter account name')),
                'email' => $this->ask(trans('Enter account email')),
                'password' => $this->ask(trans('Enter account password')),
            ];

            /** @var UserService $userService */
            $userService = app()->make(UserService::class);

            $userService->create($userData);

            $this->info(trans('Admin account successfully created'));

        } catch (Throwable $exception) {

            $this->logError(trans('Failed to create admin user'), $exception);

        }

        return 0;
    }
}

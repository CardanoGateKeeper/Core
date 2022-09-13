<?php

namespace App\Console\Commands;

use Throwable;
use App\Services\UserService;
use App\Exceptions\AppException;

class ChangePassword extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change an account password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {

            $accountEmail = $this->ask(trans('Enter account email'));
            $newAccountPassword = $this->ask(trans('Enter new account password'));

            /** @var UserService $userService */
            $userService = app()->make(UserService::class);

            $user = $userService->findByEmail($accountEmail);

            if (!$user) {
                throw new AppException(trans('Account with that email not found'));
            }

            $userService->changePassword($user, $newAccountPassword);

            $this->info(trans('Account password changed'));

        } catch (Throwable $exception) {

            $this->logError(trans('Failed to change account password'), $exception);

        }

        return 0;
    }
}

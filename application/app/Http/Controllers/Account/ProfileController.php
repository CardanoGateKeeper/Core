<?php

namespace App\Http\Controllers\Account;

use Throwable;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Exceptions\AppException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;

class ProfileController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Renderable
    {
        $user = Auth::user();

        return view(
            'account.profile',
            compact('user'),
        );
    }

    public function update(Request $request): RedirectResponse
    {
        try {

            $validationRules = [
                'name' => ['required', 'string', 'min:3'],
                'current_password' => ['required', $this->userService->passwordRules()],
            ];

            if (!empty($request->new_password)) {
                $validationRules['new_password'] = [
                    $this->userService->passwordRules(),
                ];
            }

            $validator = Validator::make(
                $request->all(),
                $validationRules,
            );

            if ($validator->fails()) {
                throw new AppException(sprintf(
                    '%s: %s',
                    trans('validation errors'),
                    implode(' ', $validator->errors()->all())
                ));
            }

            $this->userService->validateCurrentPassword(Auth::id(), $request->current_password);

            $this->userService->updateAccount(Auth::id(), $request->name, $request->new_password);

            return redirect()
                ->back()
                ->with('status', trans('Account updated'))
            ;

        } catch (Throwable $exception) {

            return redirectBackWithError(
                trans('Failed to update'),
                $exception
            );

        }
    }
}

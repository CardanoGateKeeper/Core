<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;

class ManageUsersController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request): Renderable
    {
        $allUsers = $this->userService->allUsers($request->search ?? null);

        return view(
            'admin.manage-users.index',
            compact('allUsers'),
        );
    }

    public function addUser(): Renderable
    {
        $user = null;

        return view(
            'admin.manage-users.form',
            compact('user'),
        );
    }

    public function edit(int $userId): Renderable|RedirectResponse
    {
        $user = $this->userService->findById($userId);

        if (!$user) {
            return redirect()
                ->route('admin.manage-users.index')
                ->with('error', trans('user does not exist'));
        }

        return view(
            'admin.manage-users.form',
            compact('user'),
        );
    }

    public function save(Request $request): RedirectResponse
    {
        try {

            $this->userService->save($request->only([
                'user_id',
                'name',
                'email',
                'password',
                'roles',
            ]));

            return redirect()
                ->route('admin.manage-users.index')
                ->with('status', $request->user_id
                    ? trans('account updated')
                    : trans('account created')
                );

        } catch (Throwable $exception) {

            return redirectBackWithError(trans('failed to save user'), $exception);

        }
    }
}

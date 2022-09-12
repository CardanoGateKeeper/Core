<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class ManageUsersController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Renderable
    {
        $allUsers = $this->userService->allUsers();

        return view(
            'admin.manage-users.index',
            compact('allUsers'),
        );
    }
}
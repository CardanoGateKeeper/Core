<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{
    public function index(): Renderable
    {
        $isAdmin = isAdmin();
        $isStaff = isStaff();

        return view(
            'dashboard.index',
            compact('isAdmin', 'isStaff'),
        );
    }
}

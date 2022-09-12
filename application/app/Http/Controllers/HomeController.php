<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function welcome(): Renderable
    {
        return view('welcome');
    }
}

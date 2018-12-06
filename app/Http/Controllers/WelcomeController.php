<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
//    protected

    public function __invoke()
    {
        return view('site.welcome');
    }
}

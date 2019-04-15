<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $business = new Business();

        $business = $business->get();

        return view('super-admin.dashboard')
            ->with('business', $business);
    }
}

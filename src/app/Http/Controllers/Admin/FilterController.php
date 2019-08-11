<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FilterSessionTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    use FilterSessionTrait;

    public function flash(Request $request)
    {
        $route_name = $request->route_name;
        $filter_name = $request->filter_name;
        $filter_item = $request->filter_item;

        $this->setItem($filter_name, $filter_item, $route_name);

        return redirect()->back();
    }
}

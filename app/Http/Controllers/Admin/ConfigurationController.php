<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    public function configurePagination(int $paginate)
    {
        $paginate = in_array($paginate, [20, 50, 100]) ? $paginate : 20;
        session()->put('paginate', $paginate);
        return back();
    }
}

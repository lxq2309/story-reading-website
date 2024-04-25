<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->setupPaginationTheme();
    }

    protected function setupPaginationTheme(): void
    {
        if (is_route('admin.*')) {
            Paginator::defaultView('pagination::admin');
        } else {
            Paginator::defaultView('pagination::client');
        }
    }
}

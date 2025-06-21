<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... bagian lainnya

    protected $routeMiddleware = [
        // middleware default lainnya...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}

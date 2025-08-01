<?php
use App\Http\Middleware\RoleMiddleware;

return [ // Just a simple middleware registration
    'role' => RoleMiddleware::class,
];
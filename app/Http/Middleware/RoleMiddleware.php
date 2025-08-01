<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: 'role:admin' or 'role:admin,coordinator'
     */
    public function handle($request, \Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
        // Debug temporal
        \Log::info('[RoleMiddleware] Usuario: ' . (auth()->user()->name ?? 'N/A') . ' | Rol: ' . (auth()->user()->role ?? 'N/A') . ' | Roles permitidos: ' . implode(',', $roles));
        // Admin always has access
        if (auth()->user()->role === 'admin') {
            return $next($request);
        }
        if (!in_array(auth()->user()->role, $roles)) {
            // DEBUG: only logging, before I used dd() which interrupted the request
            \Log::warning('[RoleMiddleware] Acceso denegado', [
                'rol_usuario' => auth()->user()->role,
                'roles_permitidos' => $roles,
                'ruta' => $request->path(),
                'user_id' => auth()->user()->id,
                'user_email' => auth()->user()->email ?? null,
            ]);
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
        return $next($request);
    }
}
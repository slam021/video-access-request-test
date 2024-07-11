<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAble
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $user = auth()->user();

        //waitress dan manager
        if($user->role_id != 1){
            return response('tidak punya hak akses', 403);
        }

        return $next($request);
    }
}

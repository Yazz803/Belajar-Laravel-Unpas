<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Logicnya
        // user sudah login atau belum
        // jadi ini nanti ketika user login, tapi usernamenya bukan yazz, maka tampilkan 403 | forbidden, dan tentunya dia gk bisa mengakses dashboard/categories, kecuali yg login itu usernamenya yazz
        // jadi check() itu mengecek apakah user sudah login atau belum (menghasilkan nilai true ketika sudah login), dan guest() itu ketika user belum login (menghasilkan nilai true, jadi kebalikannya gitu sama check)
        if(!auth()->check() || !auth()->user()->must_admin){ // jika user belum login atau dia bukan yazz, kasih abort
            abort(403); // jika user belum login, maka tampilannya 403 | forbidden
        }
        return $next($request);
    }
}

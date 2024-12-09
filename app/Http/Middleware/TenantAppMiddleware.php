<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantAppMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->user()->current_company_id) {
            return redirect()->route('companies.select.index');
        }

        if (! auth()->user()->userHasCompany(auth()->user()->current_company_id)) {
            auth()->user()->destroyCompanySession();

            return redirect()->route('companies.select.index');
        }

        $request->user()->setCompany(auth()->user()->current_company_id);

        return $next($request);
    }
}

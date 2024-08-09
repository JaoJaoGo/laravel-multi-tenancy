<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Company;
use App\Tenant\ManagerTenant;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = $this->getCompany($request->getHost());

        if(!$company && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        } else if($request->url() != route('404.tenant')) {
            app(ManagerTenant::class)->setConnection($company);
        }

        return $next($request);
    }

    public function getCompany($host) {
        return Company::where('domain', $host)->first();
    }
}

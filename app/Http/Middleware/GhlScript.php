<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GhlScript
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Debugbar::disable();

        $company = $request->route('company');

        if(!$company) {
            return response()->json(['error' => 'Invalid Script'], 404);
        }

        if(app()->isLocal()) {
            return $next($request);
        }


        logger('pasok dito');

        /* $referer = $request->header('referer');
        $ghlDomain = $company->data['domain'] ?? null;

        if ($ghlDomain && $referer) {
            if (parse_url($referer, PHP_URL_HOST) !== $ghlDomain) {
                return response()->json(['error' => 'Invalid Referer'], 404);
            }
        } else if (!$referer) {
            return response()->json(['error' => 'Invalid Script'], 404);
        } */



        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If there is an Authorization token and match the valid Secrets allow the request Else Abort
        // We do this so there is no directly access from Projects Routes without validation
        // While the Api gateway always attach an authorization code on every request based on the service
        $validSecrets = explode(",",env('ACCEPTED_SECRETS'));
        if (in_array($request->header('Authorization'),$validSecrets)){

            return $next($request);
        }
        abort(Response::HTTP_UNAUTHORIZED);
    }
}

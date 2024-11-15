<?php

namespace App\Http\Middleware;

use App\Models\UserLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $link = $request->route('link');

        $userLink = UserLink::where('link', $link)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();

        if (!$userLink) {
            abort(404, 'Link not found or expired');
        }

        $request->route()->setParameter('link', $userLink);

        return $next($request);
    }
}

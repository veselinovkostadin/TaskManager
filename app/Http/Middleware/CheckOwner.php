<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route("project")) {
            if ($request->route("project")->user_id != auth()->id()) {
                return redirect()->back();
            }
        }

        if ($request->route("task")) {

            if ($request->route("task")->load('project')->project->user_id != auth()->id()) {
                return redirect()->back();
            }
        }
        return $next($request);
    }
}

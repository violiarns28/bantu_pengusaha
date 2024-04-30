<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLoggedin
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
        if ($request->session()->get('id')) {
            return $next($request);
        }

        // return back()->with('error','You\'re not logged in!');
        return redirect('/')->with('error','You\'re not logged in!');
    }
}

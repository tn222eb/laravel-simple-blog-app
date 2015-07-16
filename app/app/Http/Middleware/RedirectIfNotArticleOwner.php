<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotArticleOwner
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
        $article = $request->route()->parameter('articles');

        if ($article->user->id != Auth::user()->id)
        {
            return redirect('/articles/' . $article->id);
        }

        return $next($request);
    }
}

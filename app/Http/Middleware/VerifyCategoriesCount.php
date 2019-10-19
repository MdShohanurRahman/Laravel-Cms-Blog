<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoriesCount
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
        if (Category::all()->count() == 0) {

            session()->flash('error', 'you need to add categories to be able to create post');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}

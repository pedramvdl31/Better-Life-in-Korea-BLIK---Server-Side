<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
use URL;
use Laracasts\Flash\Flash;
use Auth;

class OnlyAuth
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            Flash::error('You must be logged in to view the page');
            return redirect('/');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Jenssegers\Agent\Agent;
use Closure;

class mobile
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
        $response = $next($request);
        $agent = new Agent();
        if($agent->isMobile()){
            if(substr( $request->path(), 0, 2 ) != "/m"){
                $url = '/m/'.$request->path();
                return redirect($url);
            }
            
        }
        return $response;
    }
}

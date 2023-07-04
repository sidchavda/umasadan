<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use DB;
use App\Models\User;
use ApiToken;
class TokenAuthorization extends BaseController
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
        if(!$request->bearerToken()){
            return $this->sendError([],trans('messages.token_missing'),401);
        }
        try{
            $token = $request->bearerToken();
            $data = ApiToken::decodeToken($token);
            if(!is_int($data)){
                return  $this->sendError([],trans('messages.user_not'),config('constants.status_code.not_found'));
            }
        } 
        catch(\Exception $e){ 
           
            return $this->sendError([],trans('messages.token_invalid'),401);
        }
        return $next($request);
    }
}

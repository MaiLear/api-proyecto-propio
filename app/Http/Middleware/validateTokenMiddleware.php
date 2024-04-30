<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Illuminate\Support\Facades\Redirect;

class validateTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function renewToken(){
        $payload = [
            "data" => auth("customers")->user()->id,
            "exp" => time() + 3600
        ];
        $jwt = JWT::encode($payload, env("SECRET_KEY"), "HS256");
        return $jwt;
    }


    public function handle(Request $request, Closure $next): Response
    {

        $token = explode(' ', $request->header("Authorization"))[1] ?? '';
        if (!$token) {
            return response()->json(["msg" => "Unauthorize", "token" => "undefined", "status" => 500]);
        }
        try {
            $decode = JWT::decode($token, new Key(env("SECRET_KEY"), "HS256"));
            $tokenTime = $decode->exp;
            $tokenTimeRenew = $decode->exp - 900;
            if (time() >= $tokenTimeRenew && time() < $tokenTime) {
                $jwt = $this->renewToken();
                $request->attributes->add(["msg" => "token renove sucessfull", "token" => $jwt, "status" => 200]);
            }
            else if( time() > $tokenTime){
                $request->attributes->add(["msg" => "token invalid", "token" =>'', "status" => 500]);

            }
            else{
                $request->attributes->add(["msg" => "token its valid", "token" =>'', "status" => 200]);
            }
            $request['customer_id'] = $decode->data;
            return $next($request);
        } catch (Exception $error) {
            return ["msg" => $error, "token" => "undefined", "status" => 500];
        }
    }
}

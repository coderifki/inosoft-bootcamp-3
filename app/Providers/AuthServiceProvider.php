<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt', function (Request $request) {
            $token = $request->bearerToken();

            if ($token) {
                try {
                    $tokenPayload = JWTAuth::decode($token, env('JWT_SECRET'), ['HS256']);

                    return \App\Models\User::find($tokenPayload)->first();
                } catch (\Exception $th) {
                    Log::error($th);
                    return null;
                }
            }

            return null;
        });
    }
}

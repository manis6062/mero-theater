<?php

namespace App\Http\Middleware;

use App\CrmModel;
use App\User;
use Closure;

class ApiAuthentication
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
        $apiToken = $request->header('api-token');
        $user = CrmModel::where('api_token', $apiToken)->first();
        if (!$user || $apiToken == NULL) {
            $message['status'] = 401;
            $message['error'] = true;
            $message['message'] = "You are not authorized";
            return response()->json($message);
        }
        $request->request->add(['loggedInUserId' => $user->id]);
        return $next($request);
    }
}

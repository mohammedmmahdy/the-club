<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomeAuthProcess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        switch ($type) {
            case 'customer':
                # code...
                break;
            case 'company':

                // 0 => in progress, 1 => Pending, 2 => Approved, 3 => Rejected, 4 => Deactivate

                switch (auth('api.company')->user()->status) {
                    case '0':
                        return response()->json(['msg' => 'Complate your Prfile'], 406);

                        break;
                    case '1':
                        return response()->json(['msg' => 'Your account is pending'], 406);

                        break;
                    case '3':
                        return response()->json(['msg' => 'Your account is rejected'], 406);
                        break;
                    case '4':
                        return response()->json(['msg' => 'Your account is deactivate'], 406);
                        break;

                    default:
                        # code...
                        break;
                }

            break;
            case 'driver':

                // 0 => in progress, 1 => Pending, 2 => Approved, 3 => Rejected, 4 => Deactivate

                switch (auth('api.driver')->user()->status) {
                    case '0':
                        return response()->json(['msg' => 'Complate your Prfile'], 406);

                        break;
                    case '1':
                        return response()->json(['msg' => 'Your account is pending'], 406);

                        break;
                    case '3':
                        return response()->json(['msg' => 'Your account is rejected'], 406);
                        break;
                    case '4':
                        return response()->json(['msg' => 'Your account is deactivate'], 406);
                        break;

                    default:
                        # code...
                        break;
                }
            break;

            default:
                # code...
                break;
        }

        return $next($request);
    }
}

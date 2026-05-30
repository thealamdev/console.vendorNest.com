<?php

namespace Modules\AuthManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Support\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Modules\AuthManagement\Events\UserLogoutEvent;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request to log out the user by deleting their current access token.
     */
    public function __invoke(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            broadcast(new UserLogoutEvent($request->user()->id));

            return ApiResponse::success(
                message: 'Logged out successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: 'Failed to logout',
                code: 500
            );
        }
    }
}

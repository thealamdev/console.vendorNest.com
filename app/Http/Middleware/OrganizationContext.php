<?php

namespace App\Http\Middleware;

use App\Support\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagement\Models\OrganizationMember;
use Symfony\Component\HttpFoundation\Response;

class OrganizationContext
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Auth first
        $user = Auth::user();

        if (!$user) {
            return ApiResponse::error(message: 'Unauthenticated.', code: 401);
        }

        // 2. Then org context
        $orgId = $request->header('X-Organization-Id');

        if (!$orgId) {
            return ApiResponse::error(message: 'Organization context is required.');
        }

        // 3. Membership check
        $isMember = OrganizationMember::query()
            ->where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->exists();

        if (!$isMember) {
            return ApiResponse::error(
                message: 'You are not a member of this organization.',
                code: 403
            );
        }

        return $next($request);
    }
}

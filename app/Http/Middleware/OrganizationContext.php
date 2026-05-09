<?php

namespace App\Http\Middleware;

use App\Support\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
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
        $orgId = $request->header('X-Organization-Id');

        if (!$orgId) {
            return ApiResponse::error(
                message: 'Organization context is required.',
            );
        }


        // $user = Auth::user();

        // if (!$user) {
        //     return response()->json([
        //         'message' => 'Unauthenticated.'
        //     ], 401);
        // }

        // // 3. Check if user belongs to this organization
        // $isMember = OrganizationMember::query()
        //     ->where('user_id', $user->id)
        //     ->where('organization_id', $orgId)
        //     ->exists();

        // if (!$isMember) {
        //     return response()->json([
        //         'message' => 'You are not a member of this organization.'
        //     ], 403);
        // }

        // // 4. Attach organization context to request (IMPORTANT)
        // $request->attributes->set('organization_id', (int) $orgId);

        return $next($request);
    }
}

<?php


if (!function_exists('activeOrganizationId')) {
    function activeOrganizationId(): ?string
    {
        $orgId = request()->header('X-Organization-Id');

        return $orgId ? (string) $orgId : null;
    }
}

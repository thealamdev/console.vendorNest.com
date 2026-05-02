<?php

namespace Modules\UserManagement\Enums;

enum Role: string
{
    case SUPER_ADMIN    = 'super-admin';
    case VENDOR_OWNER   = 'vendor-owner';
}

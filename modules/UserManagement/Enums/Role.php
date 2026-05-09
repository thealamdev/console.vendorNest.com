<?php

namespace Modules\UserManagement\Enums;

use App\Support\Traits\HasEnumsCollection;

enum Role: string
{
    use HasEnumsCollection;
    
    case SUPER_ADMIN    = 'super-admin';
    case VENDOR_OWNER   = 'vendor-owner';
}

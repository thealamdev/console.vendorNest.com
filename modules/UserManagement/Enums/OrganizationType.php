<?php

namespace Modules\UserManagement\Enums;

use App\Support\Traits\HasEnumsCollection;

enum OrganizationType: string
{
    use HasEnumsCollection;

    case PLATFORM   = 'platform';
    case VENDOR     = 'vendor';
}

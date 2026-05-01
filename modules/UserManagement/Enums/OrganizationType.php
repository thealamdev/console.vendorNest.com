<?php

namespace Modules\UserManagement\Enums;

use App\Traits\HasEnumsCollection;

enum OrganizationType: string
{
    use HasEnumsCollection;

    case PLATFORM   = 'platform';
    case VENDOR     = 'vendor';
    case GLOBAL     = 'global';
}

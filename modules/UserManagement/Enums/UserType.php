<?php

namespace Modules\UserManagement\Enums;

use App\Traits\HasEnumsCollection;

enum UserType: string
{
    use HasEnumsCollection;

    case PLATFORM   = 'platform';
    case VENDOR     = 'vendor';
    case BUYER      = 'buyer';
}

<?php

namespace App\Enums;

use App\Traits\EnumMethods;
use ArchTech\Enums\InvokableCases;

enum RentLocationEnum: int
{

    use EnumMethods;
    //status
    case home = 1;
    case company = 2;

    public static function keyName(): string
    {
        return 'treatment_status';
    }
}

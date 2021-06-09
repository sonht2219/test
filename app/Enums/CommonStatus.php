<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CommonStatus extends Enum
{
    const ACTIVE =   1;
    const INACTIVE =   -1;
}

<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EventStatusType extends Enum
{
    public const Verifying  = 1;
    public const InProgress = 2;
    public const Completed  = 3;
    public const Canceled   = 4;
}

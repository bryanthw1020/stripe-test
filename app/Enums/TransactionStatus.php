<?php

namespace App\Enums;

use App\Support\Abstracts\Enum;

final class TransactionStatus extends Enum
{
    const Pending = 0;
    const Success = 1;
    const Fail = 2;
}

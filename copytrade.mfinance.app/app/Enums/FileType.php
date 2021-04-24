<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FileType extends Enum
{
    const SRV = 'SRV';
    const TPL = 'Tpl';
    const LIB = 'Lib';
    const FILE = 'File';
    const EX4 = 'Ex4';
    const EXE = 'Exe';
    const PAIRS = 'Pairs';
}

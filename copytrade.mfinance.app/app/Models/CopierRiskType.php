<?php

namespace App\Models;

class CopierRiskType
{
    const NONE = 0;
    const MULTIPLIER = 1;
    const FIXED_LOT = 2;
    const MONEY_RATIO = 3;
    const RISK_PERCENT = 4;
    const SCALING = 5;

    public static function title($risk_type)
    {
        switch ($risk_type) {
      case CopierRiskType::FIXED_LOT:
        return 'Fixed Lots';
      case CopierRiskType::MULTIPLIER:
        return 'Multiplier';
      case CopierRiskType::MONEY_RATIO:
        return 'Money Ratio';
      case CopierRiskType::RISK_PERCENT:
        return 'Risk Percent';
        case CopierRiskType::SCALING:
          return 'Risk Scaling';
    }

        return $risk_type;
    }

    public static function title_short($risk_type)
    {
        switch ($risk_type) {
      case CopierRiskType::FIXED_LOT:
        return 'Fixed';
      case CopierRiskType::MULTIPLIER:
        return 'Mult';
      case CopierRiskType::MONEY_RATIO:
        return 'Ratio';
      case CopierRiskType::RISK_PERCENT:
        return 'Perc';
        case CopierRiskType::SCALING:
          return 'Scaling';
    }

        return $risk_type;
    }
}

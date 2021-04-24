<?php

namespace App\Models;

class FilterCondition
{
    const NONE = 0;
    const EQUAL = 1;
    const NOT_EQUAL = 2;
    const CONTAIN = 3;
    const NOT_CONTAIN = 4;

    public static function all() {
      return [
        self::NONE => self::title(self::NONE),
        self::EQUAL => self::title(self::EQUAL),
        self::NOT_EQUAL => self::title(self::NOT_EQUAL),
        self::CONTAIN => self::title(self::CONTAIN),
        self::NOT_CONTAIN => self::title(self::NOT_CONTAIN)];
    }

    public static function title($value)
    {
        switch ($value) {
          case FilterCondition::NONE:
            return 'None';
          case FilterCondition::EQUAL:
            return 'Equal';
          case FilterCondition::NOT_EQUAL:
            return 'Not Equal';
          case FilterCondition::CONTAIN:
            return 'Contain';
          case FilterCondition::NOT_CONTAIN:
            return 'Not Contain';
      }
    }
}

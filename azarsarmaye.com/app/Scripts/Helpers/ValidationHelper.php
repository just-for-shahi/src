<?php

namespace App\Scripts\Helpers;


use App\Enums\Wallet\Status;
use Illuminate\Validation\Rule;
use RuntimeException;

/**
 * Class ValidationEnum
 * @description
 * Responsible for generating validation rules.
 * @package App\Scripts\Enums
 */
class ValidationHelper
{
    public const MOBILE = 'digits:11|regex:' . RegexEnum::MOBILE;
    public const URL = 'url';
    public const CARD_NUMBER = 'string|size:16';
    public const TEL = 'digits:11';
    public const INT = 'integer|max:2147483647|min:0';
    public const SMALL_INT = 'integer|min:0|max:65535';
    public const SMALL_NUMBER = 'numeric|min:0|max:65535';
    public const TINYINT = 'integer|min:0|max:99';
    public const BOOLEAN = 'boolean';
    public const NUMERIC = 'numeric|max:2147483647';
    public const ARRAY = 'array';
    //---- Foreign keys
    public const ID = 'integer|max:2147483647|min:0';
    public const ACTIVE_WALLET_ID = 'integer|max:2147483647|min:0|exists:wallets,id,status,' . Status::ACTIVE;
    //------------End of foreign keys

    //Dates
    public const YEAR = 'digits:4';

    //Others
    public const STRING = 'string|max:191';
    public const EMPTY_RULE = '';
    public const SMALLTEXT = 'string|max:1000';
    public const TEXT = 'string|max:3000';
    public const PRICE = 'numeric|min:0|max:999999999';
    public const ATTACHMENT = 'file|mimes:jpeg,png,zip';

    /**
     * @param $param
     * @param bool $required
     * @param string $extra
     * @return string
     */
    public static function get($param, $required = true, $extra = '')
    {
        $param = strtoupper($param);
        $rule = self::append(self::baseRule($required), constant("self::$param"));

        return self::append($rule, $extra);
    }

    /**
     * @param bool $required
     * @return string
     */
    private static function baseRule($required = true)
    {
        return $required ? 'required' : 'sometimes|nullable';
    }

    /**
     * @return array
     */
    public static function methods()
    {
        return [
            'required', 'string', Rule::in(Enum::GET, Enum::POST, Enum::PUT, Enum::PATCH, Enum::DELETE)
        ];
    }

    /**
     * @param array $array
     * @param bool $required
     * @param string|null $rule
     * @return array
     */
    public static function inArray(array $array, $required = false, string $rule = null)
    {
        $return = [];
        if ($rule) {
            $return = explode('|', self::get($rule, $required));
        }
        if ($rule == null && $required) {
            $return[] = 'required';
        }
        $return[] = Rule::in($array);

        return $return;
    }

    /**
     * @param int $chars
     * @param bool $required
     * @param string $extra
     * @return string
     */
    public static function stringOf($chars = 30, $required = true, $extra = '')
    {
        $rule = self::append(self::baseRule($required), "max:$chars");
        return self::append($rule, $extra);
    }

    public static function foreign($table, $required = true, $field = 'id', $extra = '')
    {
        $rule = self::appendArray(self::baseRule($required), [
            self::INT,
            "exists:$table,$field",
        ]);

        return self::append($rule, $extra, ',');
    }

    private static function append(string $rule, string $extra, string $delimiter = '|')
    {
        return $extra ? $rule . $delimiter . $extra : $rule;
    }

    private static function appendArray(string $rule, array $extras, string $delimiter = '|')
    {
        return self::append($rule, implode($delimiter, $extras), $delimiter);
    }
}

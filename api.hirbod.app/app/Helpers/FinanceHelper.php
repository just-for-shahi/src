<?php

namespace App\Helpers;


class FinanceHelper{
    public static function tmnToRls($amount){
        return intval($amount.'0');
    }
    public static function rlsToTmn($amount){
        return intval(substr($amount, 0, -1));
    }
    public function creditTypes($code){
        switch ($code){
            case 0:
                return 'نصب خودتون';
                break;
            case 1:
                return 'نصب تیم‌تون';
                break;
            case 2:
                return 'هدیه عضویت';
                break;
            case 3:
                return 'هدیه ارتقا';
                break;
            case 4:
                return 'هدایای دیگر';
                break;
            case 5:
                return 'عضویت تیم‌تون';
                break;
            case 6:
                return 'درآمد شارژ';
                break;
            case 7:
                return 'درآمد بسته اینترنت';
                break;
            case 8:
                return 'درآمد قبض';
                break;
            case 9:
                return 'خرید از بازار';
                break;
            case 10:
                return 'خرید تیم‌تون';
                break;
            default:
                return 'خطا در تشخیص';
                break;
        }
    }
    public function financeCreditsStatus($code){
        switch ($code){
            case 0:
                return 'کسب شده';
                break;
            case 1:
                return 'تسویه‌شده';
                break;
            case 2:
                return 'منتظر تائید';
                break;
            case 3:
                return 'رد شده';
                break;
            case 4:
                return 'غیرقابل قبول';
                break;
            default:
                return 'خطا در تشخیص';
                break;
        }
    }
    public function getTransactionStatus($id){
        switch ($id){
            case 0:
                return 'ایجاد شده';
                break;
            case 1:
                return 'انجام شده';
                break;
            case 2:
                return 'مشکل در تائید پرداخت';
                break;
            case 3:
                return 'پرداخت توسط مدیر سیستم';
                break;
            case 4:
                return 'تخفیف داده شده';
                break;
            default:
                return 'ایجاد شده';
                break;
        }
    }
    public static function banks(){
        return array(
            1 => 'بانک اقتصادنوین',
            2 => 'بانک انصار',
            3 => 'بانک ایران‌زمین',
            4 => 'بانک پارسیان',
            5 => 'بانک پاسارگاد',
            6 => 'بانک تات',
            7 => 'بانک تجارت',
            8 => 'بانک توسعه‌تعاون',
            9 => 'بانک توسعه‌صادرات ایران',
            10 => 'بانک حکمت‌ایرانیان',
            11 => 'بانک دی',
            12 => 'بانک رفاه‌کارگران',
            13 => 'بانک سامان',
            14 => 'بانک سپه',
            15 => 'بانک سرمایه',
            16 => 'بانک سینا',
            17 => 'بانک شهر',
            18 => 'بانک صادرات ایران',
            19 => 'بانک صنعت‌ومعدن',
            20 => 'بانک قرض‌الحسنه‌مهر ایران',
            21 => 'بانک قوامین',
            22 => 'بانک کارآفرین',
            23 => 'بانک کشاورزی',
            24 => 'بانک گردشگری',
            25 => 'بانک مرکزی',
            26 => 'بانک مسکن',
            27 => 'بانک ملت',
            28 => 'بانک ملی ایران',
            29 => 'بانک مهراقتصاد',
            30 => 'پست‌بانک ایران',
            31 => 'موسسه‌اعتباری توسعه',
            32 => 'موسسه‌اعتباری کوثر',
        );
    }
    public static function bankName($id){
        return self::banks()[$id];
    }
    public static function cards(){
        return array(
            627412 => 1,
            627381 => 2,
            505785 => 3,
            622106 => 4,
            639194 => 4,
            627884 => 4,
            639347 => 5,
            502229 => 5,
            636214 => 6,
            627353 => 7,
            502908 => 8,
            627648 => 9,
            207177 => 9,
            636949 => 10,
            502938 => 11,
            589463 => 12,
            621986 => 13,
            589210 => 14,
            639607 => 15,
            639346 => 16,
            502806 => 17,
            603769 => 18,
            627961 => 19,
            606373 => 20,
            639599 => 21,
            627488 => 22,
            502910 => 22,
            603770 => 23,
            639217 => 23,
            505416 => 24,
            636795 => 25,
            628023 => 26,
            610433 => 27,
            991975 => 27,
            603799 => 28,
            639370 => 29,
            627760 => 30,
            628157 => 31,
            505801 => 32,
        );
    }
    public static function checkCard($card){
        if(array_key_exists(substr(str_replace('-', '', $card), 0, 6), self::cards())){
            return true;
        }
        return false;
    }
    public static function checkCardBank($card, $bank){
        $card = substr(str_replace('-', '', $card), 0, 6);
        $cards = self::cards();
        if(self::checkCard($card) === true ){
            if($bank == $cards[$card]){
                return true;
            }else{
                // Credit Card Number not Provided by selected Bank
                return false;
            }
        }else{
            // Not Valid Credit Card Number
            return false;
        }

    }
    public static function iban(){
        return array(
            1 => '055',
            2 => null,
            3 => null,
            4 => '054',
            5 => '058',
            6 => null,
            7 => '018',
            8 => null,
            9 => '020',
            10 => null,
            11 => null,
            12 => '013',
            13 => '056',
            14 => '015',
            15 => '058',
            16 => null,
            17 => null,
            18 => '019',
            19 => '011',
            20 => null,
            21 => null,
            22 => '053',
            23 => '016',
            24 => null,
            25 => '010',
            26 => '014',
            27 => '012',
            28 => '017',
            29 => null,
            30 => '021',
            31 => '051',
            32 => null,
        );
    }
    public static function checkIbanBank($iban, $bank){
        if(substr($iban, 0, 2) === 'IR'){
            $ibanArray = self::iban();
            $iban = str_replace(' ', '', $iban);
            if(substr($iban, 4, 3) == $ibanArray[$bank] || substr($iban, 4, 3) == null){
                return true;
            }else{
                // Not selected Bank is the provider of Iban Account
                return false;
            }
        }else{
            // Not Valid Iranian Bank Iban
            return false;
        }
    }
    public function getCreditCardLogo($creditCard){
        $preCode=intval(substr($creditCard, 0, 6));
        $cards=self::cards();
        if (array_key_exists($preCode, $cards)){
            switch ($cards[$preCode]){
                case 1:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/en.png';
                    break;
                case 2:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/ansar.png';
                    break;
                case 3:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
                case 4:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/parsian.png';
                    break;
                case 5:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/pasargad.png';
                    break;
                case 6:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
                case 7:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/tejarat.png';
                    break;
                case 8:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/tosee-taavon.png';
                    break;
                case 9:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/tosee-saderat.png';
                    break;
                case 10:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/hekmat.png';
                    break;
                case 11:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/dey.png';
                    break;
                case 12:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/refah.png';
                    break;
                case 13:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/saman.png';
                    break;
                case 14:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/sepah.png';
                    break;
                case 15:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/sarmaye.png';
                    break;
                case 16:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/sina.png';
                    break;
                case 17:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/shahr.png';
                    break;
                case 18:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/saderat.png';
                    break;
                case 19:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/sanatmadan.png';
                    break;
                case 20:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/ghmi.png';
                    break;
                case 21:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/ghavamin.png';
                    break;
                case 22:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/karafarin.png';
                    break;
                case 23:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/keshavarzi.png';
                    break;
                case 24:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/gardeshgari.png';
                    break;
                case 25:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/markazi.png';
                    break;
                case 26:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/maskan.png';
                    break;
                case 27:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/mellat.png';
                    break;
                case 28:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/melli.png';
                    break;
                case 29:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
                case 30:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/postbank.png';
                    break;
                case 31:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
                case 32:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
                case 33:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
                default:
                    return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
                    break;
            }
        }
        return ResponseHelper::$SARA.'/defaults/finance/banks/default.png';
    }
    public function getBankAccountStatus($id){
        switch ($id){
            case 0:
                return 'منتظر تائید';
                break;
            case 1:
                return 'تائید شده';
                break;
            case 2:
                return 'رد شده';
                break;
            case 3:
                return 'مسدود شده';
                break;
            case 4:
                return 'در دست بررسی';
                break;
            case 5:
                return 'حکم قضایی';
                break;
            default:
                return 'خطا در سیستم';
                break;
        }
    }
}
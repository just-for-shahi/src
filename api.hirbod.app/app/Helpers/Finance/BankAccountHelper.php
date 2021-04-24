<?php


namespace App\Helpers\Finance;



use App\Http\Controllers\V1\Finance\BankAccount;

class BankAccountHelper
{

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

    public static function ibanBank($iban){
        if(substr($iban, 0, 2) === 'IR'){
            $iban = str_replace(' ', '', $iban);
            return self::banks()[array_search(substr($iban, 4, 3), self::iban())];
        }else{
            return "عدم تشخیص";
        }
    }
    public function getCreditCardLogo($creditCard){
        $preCode=intval(substr($creditCard, 0, 6));
        $cards=self::cards();
        if (array_key_exists($preCode, $cards)){
            switch ($cards[$preCode]){
                case 1:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/en.png';
                    break;
                case 2:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/ansar.png';
                    break;
                case 3:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
                case 4:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/parsian.png';
                    break;
                case 5:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/pasargad.png';
                    break;
                case 6:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
                case 7:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/tejarat.png';
                    break;
                case 8:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/tosee-taavon.png';
                    break;
                case 9:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/tosee-saderat.png';
                    break;
                case 10:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/hekmat.png';
                    break;
                case 11:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/dey.png';
                    break;
                case 12:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/refah.png';
                    break;
                case 13:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/saman.png';
                    break;
                case 14:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/sepah.png';
                    break;
                case 15:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/sarmaye.png';
                    break;
                case 16:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/sina.png';
                    break;
                case 17:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/shahr.png';
                    break;
                case 18:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/saderat.png';
                    break;
                case 19:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/sanatmadan.png';
                    break;
                case 20:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/ghmi.png';
                    break;
                case 21:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/ghavamin.png';
                    break;
                case 22:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/karafarin.png';
                    break;
                case 23:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/keshavarzi.png';
                    break;
                case 24:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/gardeshgari.png';
                    break;
                case 25:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/markazi.png';
                    break;
                case 26:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/maskan.png';
                    break;
                case 27:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/mellat.png';
                    break;
                case 28:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/melli.png';
                    break;
                case 29:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
                case 30:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/postbank.png';
                    break;
                case 31:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
                case 32:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
                case 33:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
                default:
                    return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
                    break;
            }
        }
        return ResponseHelpers::$RESPONSE_STATIC_SERVER.'/defaults/finance/banks/default.png';
    }

    public static function cardBank($card){
        $card = substr(str_replace('-', '', $card), 0, 6);
        $cards = self::cards();
        if(self::checkCard($card) === true ){
            return self::banks()[$cards[$card]];
        }else{
            return "عدم تشخیص";
        }
    }

    public static function summary($account){
        $account = BankAccount::find($account);
        return "شماره شبا: ".$account->iban." / ".self::ibanBank($account->iban);
    }

    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">در حال بررسی</span>';
                break;
            case 1:
                return '<span class="status-success">تائید شده</span>';
                break;
            case 2:
                return '<span class="status-reject">رد شده</span>';
                break;
            case 3:
                return '<span class="status-reject">مسدود</span>';
                break;
            case 4:
                return '<span class="status-pending">در دست بررسی</span>';
                break;
            case 5:
                return '<span class="status-reject">مشکل قانونی</span>';
                break;
            default:
                return '<span class="status-reject">خطای سیستمی</span>';
                break;
        }
    }


}

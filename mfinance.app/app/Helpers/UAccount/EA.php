<?php


namespace App\Helpers\UAccount;


abstract class EA
{
    public static function ea($ea){
        try{
            switch (intval($ea)){
                default:
                case \App\Enums\UAccount\EA::NAZANIN:
                    return \App\Enums\UAccount\EA::NAZANIN_HTML;
                    break;
                case \App\Enums\UAccount\EA::MILAD:
                    return \App\Enums\UAccount\EA::MILAD_HTML;
                    break;
                case \App\Enums\UAccount\EA::SF:
                    return \App\Enums\UAccount\EA::SF_HTML;
                    break;
                case \App\Enums\UAccount\EA::CORRELATION:
                    return \App\Enums\UAccount\EA::CORRELATION_HTML;
                    break;
                case \App\Enums\UAccount\EA::VANGUS:
                    return \App\Enums\UAccount\EA::VANGUS_HTML;
                    break;
                case \App\Enums\UAccount\EA::PRECIS:
                    return \App\Enums\UAccount\EA::PRECIS_HTML;
                    break;
                case \App\Enums\UAccount\EA::MIEA:
                    return \App\Enums\UAccount\EA::MIEA_HTML;
                    break;
            }
        }catch (\Exception $e){
            return abort(500);
        }
    }
}

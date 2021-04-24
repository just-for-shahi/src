<?php
// Institute helper
use Services\Institute\Response\ResInstitute;

function instituteMap($institute)
{
    if (!$institute) return null;
    return mapper(new ResInstitute(), $institute, function ($ir) {
        $ir['logo'] = $ir['logo'] != null ? getBaseUri($ir['logo']) : null;
        return $ir;
    });
}

function instType()
{
    $type = new class {

        public function toString($tp)
        {
            switch ("$tp") {
                case "0":
                {
                    return 'type1';
                }
                case "1":
                {
                    return 'type2';
                }
                case "2":
                {
                    return 'type3';
                }
            }
        }

        public function toNumber($tp)
        {
            switch ("$tp") {
                case "type1":
                {
                    return \Services\Institute\Enum\TypeInstitute::Type1;
                }
                case "type2":
                {
                    return \Services\Institute\Enum\TypeInstitute::Type2;
                }
                case 'type3':
                {
                    return \Services\Institute\Enum\TypeInstitute::Type3;
                }
            }
        }
    };
    return $type;
}



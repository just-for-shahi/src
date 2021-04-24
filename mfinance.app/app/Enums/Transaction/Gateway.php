<?php


namespace App\Enums\Transaction;


abstract class Gateway
{
    const TOPCHANGE=0;
    const WEBMONEY=1;
    const PERFECTMONEY=2;
    const BITCOIN=3;
}

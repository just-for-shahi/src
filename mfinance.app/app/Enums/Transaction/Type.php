<?php


namespace App\Enums\Transaction;


abstract class Type
{
    const INVESTMENT = 0;
    const DEPOSIT = 1;
    const WITHDRAW = 2;
    const TRANSFER = 3;
    const SYSTEM = 4;
    const PROFIT = 5;

    const INVESTMENT_HTML = 'Investment';
    const DEPOSIT_HTML = 'Deposit';
    const WITHDRAW_HTML = 'Withdraw';
    const TRANSFER_HTML = 'Transfer';
    const SYSTEM_HTML = 'System';
    const PROFIT_HTML = 'Profit';

}

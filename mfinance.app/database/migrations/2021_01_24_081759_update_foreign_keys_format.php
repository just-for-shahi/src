<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateForeignKeysFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        //Rename AccountManagements to maccounts before FKs.
        Schema::rename('account_managements', 'maccounts');

        //FK Renames
        Schema::table('accounts', static function (Blueprint $table) {
            $table->renameColumn('captain', 'captain_id');
        });

        Schema::table('maccounts', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
            $table->renameColumn('investment', 'investment_id');
        });

        Schema::table('activities', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('branches', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('call_requests', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('device_packages', static function (Blueprint $table) {
            $table->renameColumn('device', 'device_id');
        });

        Schema::table('devices', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('faqs', static function (Blueprint $table) {
            $table->renameColumn('parent', 'parent_id');
        });

        Schema::table('investments', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
            $table->renameColumn('agent', 'agent_id');
            $table->renameColumn('branch', 'branch_id');
        });

        Schema::table('transactions', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('notifications', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('ticket_accounts', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
            $table->renameColumn('ticket', 'ticket_id');
        });

        Schema::table('ticket_replies', static function (Blueprint $table) {
            $table->renameColumn('ticket', 'ticket_id');
            $table->renameColumn('account', 'account_id');
            $table->renameColumn('reply', 'reply_id');
        });

        Schema::table('trades', static function (Blueprint $table) {
            $table->renameColumn('account_management', 'maccount_id');
        });

        Schema::table('wallets', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
        });

        Schema::table('withdraws', static function (Blueprint $table) {
            $table->renameColumn('account', 'account_id');
            $table->renameColumn('wallet', 'wallet_id');
            $table->renameColumn('investment', 'investment_id');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', static function (Blueprint $table) {
            $table->renameColumn('captain_id', 'captain');
        });

        Schema::table('maccounts', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
            $table->renameColumn('investment_id', 'investment');
        });

        Schema::table('activities', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('branches', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('call_requests', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('device_packages', static function (Blueprint $table) {
            $table->renameColumn('device_id', 'device');
        });

        Schema::table('devices', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('faqs', static function (Blueprint $table) {
            $table->renameColumn('parent_id', 'parent');
        });

        Schema::table('investments', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
            $table->renameColumn('agent_id', 'agent');
            $table->renameColumn('branch_id', 'branch');
        });

        Schema::table('transactions', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('notifications', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('ticket_accounts', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
            $table->renameColumn('ticket_id', 'ticket');
        });

        Schema::table('ticket_replies', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
            $table->renameColumn('ticket_id', 'ticket');
            $table->renameColumn('reply_id', 'reply');
        });

        Schema::table('trades', static function (Blueprint $table) {
            $table->renameColumn('maccount_id', 'account_management');
        });

        Schema::table('wallets', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
        });

        Schema::table('withdraws', static function (Blueprint $table) {
            $table->renameColumn('account_id', 'account');
            $table->renameColumn('wallet_id', 'wallet');
            $table->renameColumn('investment_id', 'investment');
        });

        //Revert
        Schema::rename('maccounts', 'account_managements');
    }
}

<?php

namespace Services\Donate\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Services\Donate\Models\Donate;
use App\Repository\Repository;
use Services\Transaction\Helpers\PaymentHelper;
use Services\Transaction\Models\Transaction;
use Services\User\Models\User;

/**
 * Donate
 * @author Sajadweb
 * Fri Dec 25 2020 02:38:30 GMT+0330 (Iran Standard Time)
 */
class DonateRepository extends Repository implements IDonateRepository
{
      /**
     * The model being queried.
     *
     * @var Donate
     */
    public $model;
    /**
     * @var mixed
     */
    private $user;
    /**
     * @var mixed
     */
    private $transaction;
    /**
     * @var mixed
     */
    private $helper;

    public function __construct(Donate $model , User $user , Transaction $transaction , PaymentHelper $helper)
    {
        $this->model = new $model();
        $this->user = new $user();
        $this->transaction = new $transaction();
        $this->helper = new $helper();
    }

    public function storeDonate($request)
    {
        DB::beginTransaction();
        $user = $this->user->whereEmail($request->email)->first();

        $amount = $request->customPrice ?? $request->valueSelect;

        if (!$user) {
            $user = $this->user->create([
                'name' => "{$request->firstName} {$request->lastName}",
                'email' => $request->email
            ]);
        }

        $donate = $this->model->create([
            'user' => $user->id,
            'amount' => $amount
        ]);


        // TODO move to transaction service
        $transaction = $this->transaction->create([
            'user' => $user->id,
            'amount' => $amount,
            'authority' => Str::random(),
            'description' => __('message.transaction.description' , ['name' => 'خیریه']),
            'transaction_type' => get_class($donate),
            'transaction_id' => $donate->id
        ]);

        if (!$donate || !$transaction) {
            DB::rollBack();
            toast(__('message.alert.error.message') , 'error');
            return back();
        }

        DB::commit();

        // TODO different payRest with different callback url and view
        return $this->helper->payRest($transaction->uuid);
    }
}

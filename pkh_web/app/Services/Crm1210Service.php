<?php

namespace App\Services;

use DB;
use Log;
use App\Models\MstBankAccount;

/**
 * Crm1210Service class
 */
class Crm1210Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListBankAccount($param)
    {
        $sqlParam = array();
        $sql      = "
            Select
                a.bank_account_id
                , a.bank_name
                , b.name
                , b.address
                , c.name as salesman_name
                , a.bank_branch
                , a.bank_account_no
                , a.bank_account_name
                , a.notes
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from
                mst_bank_account a
                left join mst_store b
                    on a.store_id = b.store_id
                left join users c
                    on b.salesman_id = c.id
            where
                a.active_flg = 1
        ";

        $sql .= $this->andWhereString($param, 'bank_name', 'a.bank_name', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'b.store_name', $sqlParam);
        $sql .= $this->andWhereString($param, 'bank_account_no', 'b.bank_account_no', $sqlParam);

        $result = array();

        return $result;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveBankAccount(
        $user,
        $param
    ) {

        if (isset($param['bank_account_id']) && $param['bank_account_id'] > 0) {
            $account = MstBankAccount::find($param['bank_account_id']);
            $this->updateRecordHeader($account, $user, false);
        } else {
            $account           = new MstBankAccount();
            $account->store_id = $param['store_id'];
            $this->updateRecordHeader($account, $user, true);
        }

        $account->bank_name         = $param['bank_name'];
        $account->bank_branch       = $param['bank_branch'];
        $account->bank_account_no   = $param['bank_account_no'];
        $account->bank_account_name = $param['bank_account_name'];
        $account->notes             = $param['notes'];

        Log::debug('save bank account ---------------------------------');
        Log::debug($account);
        DB::transaction(function () use ($account) {
            $account->save();
        });

        return $account->store_id;

    }

}

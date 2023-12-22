<?php

namespace App\Imports;

use App\Models\Invoice\Acc_account;
use App\Models\Invoice\Debtor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{

    private $branch_id;

    public function __construct($branch_id)
    {
        $this->branch_id = $branch_id;
    }

    /** 
     * @param array $row
     * ------- WithHeadingRow to accept header in excel file  and the use $row['name'] instead of $row[1]
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $parent_account = Acc_account::select('code')->where('parent_account_id', 83)
            ->get();

        //if it is not the first recored in the parent
        if (count($parent_account) > 0) {
            $account_code = $parent_account->last()->code + 1;
        } else {
            $account_code = 21111;
        }

        // record a account in accointing chart
        $debtor_account = Acc_account::create([
            'system_code' => "ACC" . generateRandomString(6),
            'code' => $account_code,
            'acc_account_type_id' => 2,
            'origin' => 0,
            'cat' => 2,
            'main_account_id' => 2,
            'parent_account_id' => 83,
            'belong_to' => 3,
            'name' => $row['company_name'],
            'level' => 5,
            'description' => "A supplier " . $row['company_name'],
        ]);

        //create the new serial code 000001
        $new_serial_number_debtor = serial_number('debtor');

        $supplier = Debtor::create([
            'new_id' => $new_serial_number_debtor,
            'acc_account_id' => $debtor_account->id,
            'code' => "BR-" . generateRandomString(6),
            'first_name' => $row['first_name'],
            'second_name' => $row['second_name'],
            'company_name' => $row['company_name'],
            'phone_number' => $row['phone_number'],
            'email' => $row['email'],
            'wallet_cash_v' => $row['wallet_cash_v'],
            'wallet_cash_e' => $row['wallet_cash_e'],
            'wallet_cash_o' => $row['wallet_cash_o'],
            'bank_name' => $row['bank_name'],
            'bank_swift' => $row['bank_swift'],
            'bank_number' => $row['bank_number'],
            'bank_name_2' => $row['bank_name_2'],
            'bank_swift_2' => $row['bank_swift_2'],
            'bank_number_2' => $row['bank_number_2'],
            'note' => $row['note'],
        ]);

        return $supplier;
    }
}

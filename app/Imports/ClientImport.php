<?php

namespace App\Imports;

use App\Models\Invoice\Acc_account;
use App\Models\Patient\Ask_for_cat;
use App\Models\Patient\Ask_for_main_cat;
use App\Models\Patient\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientImport implements ToModel, WithHeadingRow
{

    private $branch_id;

    public function __construct($branch_id)
    {
        $this->branch_id = $branch_id;

        // $this->user = Manager::select('id', 'email')->get();
    }

    /** 
     * @param array $row
     * ------- WithHeadingRow to accept header in excel file  and the use $row['name'] instead of $row[1]
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $user = $this->user->where('email', $row['email'])->first();


        // create account in account tree first
        $parent_account = Acc_account::select('code')->where('parent_account_id', 65)
            ->get();
        //if it is not the first recored in the parent
        if (count($parent_account) > 0) {
            $account_code = $parent_account->last()->code + 1;
        } else {
            $account_code = 11311;
        }
        // record a account in accointing chart
        $patient_account = Acc_account::create([
            'system_code' => "ACC" . generateRandomString(6),
            'code' => $account_code,
            'acc_account_type_id' => 6,
            'origin' => 1,
            'cat' => 2,
            'main_account_id' => 1,
            'parent_account_id' => 65,
            'belong_to' => 4,
            'name' => $row['first_name'] . " " . $row['second_name'],
            'level' => 5,
            'description' => "A customer " . $row['first_name'],
        ]);

        //create the new serial code 000001
        $new_serial_number_patient = serial_number('patient', $this->branch_id);

        $patient = Manager::create([
            'new_id' => $new_serial_number_patient,
            'acc_account_id' => $patient_account->id,
            'code' => "TTR-" . generateRandomString(6),
            'passport_number' => $row['passport_number'],
            'email' => $row['email'],
            'password' => bcrypt("first_name" . "pass"),
            'first_branch_id' => $this->branch_id,
            'first_name' => $row['first_name'],
            'second_name' => $row['second_name'],
            'birthday' => $row['birthday'],
            'gendar' => $row['gendar'],
            'phone_number' => $row['phone_number'],
            'sec_phone_number' => $row['sec_phone_number'],
            'commercial_register' => $row['commercial_register'],
            'tax_number' => $row['tax_number'],
            'note' => $row['note'],
            'creator_id' => Auth::id(),
        ]);

        // return new Ask_for_main_cat([
        //     'name'     => $row['name'],
        //     // 'email'    => $row[1], 
        //     // 'password' => Hash::make($row[2]),
        // ]);


        return $patient;
    }
}

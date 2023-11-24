<?php

namespace App\Imports;

use App\Models\School\Manager;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class Teacher_sheetImport implements ToModel, WithHeadingRow
{

    private $manager_id, $school_id, $row_number = 0, $grade_id, $class_id, $department;

    public function __construct($manager_id, $school_id)
    {
        $this->manager_id = $manager_id;
        $this->school_id = $school_id;
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

        $manager_id = $this->manager_id;
        $school_id = $this->school_id;

        //data
        //it starts from the row of 20 column
        //5= phone number
        //8= email
        //18= class
        //20= identification number
        //23= nationality
        //28= name

        $phone_number = $row[5];
        $email = $row[8];
        $name = $row[21];
        $identification_number = $row[23];

        $new_serial_number_patient = serial_number('managers');

        if ($phone_number !== null && $phone_number !== "الجوال") {
            $teacher = Manager::create([
                'new_id' => $new_serial_number_patient,
                'code' => "TCH-" . generateRandomString(6),
                'type' => 3,
                'belong_school_id' => $this->school_id,
                'belong_manager_id' => $this->manager_id,
                'first_name' => $name,
                'password' => bcrypt($phone_number . "pass"),
                'email' => $email,
                'phone_number' => $phone_number,
                'identification_number' => $identification_number,
                'from_recourse_id' => 6,
            ]);
            return $teacher;
        }


        // return new Ask_for_main_cat([
        //     'name'     => $row['name'],
        //     // 'email'    => $row[1], 
        //     // 'password' => Hash::make($row[2]),
        // ]);

        // ++$this->row_number;
    }
}
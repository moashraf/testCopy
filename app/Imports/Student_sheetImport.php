<?php

namespace App\Imports;

use App\Models\School\Student\School_grade;
use App\Models\School\Student\School_grade_class;
use App\Models\School\Student\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class Student_sheetImport implements ToModel, WithHeadingRow
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
        //2= phone number
        //4= grade, class (grade at 4 column, class at 12)
        //18= class
        //20= identification number
        //23= nationality
        //28= name

        $grade_class = $row[4];
        $phone_number = $row[2];
        $class = $row[18];
        $identification_number = $row[20];
        $nationality = $row[23];
        $name = $row[28];

        // fetch the grade and class
        if ($grade_class) {
            //select if it's grade or class
            // grade
            if (Str::contains($grade_class, ['الابتدائي', 'الاعدادي', 'الثانوي'])) {
                $check_exist_grade = School_grade::where('manager_id', $manager_id)
                    ->where('school_id', $school_id)
                    ->where('name', $grade_class)
                    ->first();

                if ($check_exist_grade) {
                    $this->grade_id = $check_exist_grade->id;
                } else {
                    $grade = School_grade::create([
                        'manager_id' => $manager_id,
                        'school_id' => $school_id,
                        'name' => $grade_class,
                    ]);
                    $this->grade_id = $grade->id;
                }
            }
            //class
            elseif (Str::length($grade_class) < 5) {
                $check_exist_class = School_grade_class::where('manager_id', $manager_id)
                    ->where('school_id', $school_id)
                    ->where('school_grade_id', $this->grade_id)
                    ->where('name', $grade_class)
                    ->first();
                if ($check_exist_class) {
                    $this->class_id = $check_exist_class->id;
                } else {
                    $class = School_grade_class::create([
                        'manager_id' => $manager_id,
                        'school_id' => $school_id,
                        'school_grade_id' => $this->grade_id,
                        'name' => $grade_class,
                    ]);
                    $this->class_id = $class->id;
                }
            } elseif (Str::contains($grade_class, ['المشتركة', 'مسار', 'العام', 'عام', 'السنة'])) {
                $this->department = $grade_class;
            }
        }

        if ($phone_number !== null && $phone_number !== "رقم جوال الطالب") {
            $student = Student::create([
                'code' => "STU-" . generateRandomString(6),
                'manager_id' => $this->manager_id,
                'school_id' => $this->school_id,
                'school_grade_id' =>  $this->grade_id,
                'school_grade_class_id' =>  $this->class_id,
                'department' => $this->department,
                'name' => $name,
                'identification_number' => $identification_number,
                'nationality' => $nationality,
                'phone_number' => $phone_number,
            ]);
            return $student;
        }


        // return new Ask_for_main_cat([
        //     'name'     => $row['name'],
        //     // 'email'    => $row[1], 
        //     // 'password' => Hash::make($row[2]),
        // ]);

        // ++$this->row_number;
    }
}

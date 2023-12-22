<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentImport implements WithMultipleSheets
{

    private $manager_id, $first_school_id;

    public function __construct($manager_id, $first_school_id)
    {
        $this->manager_id = $manager_id;
        $this->first_school_id = $first_school_id;
        // $this->user = Manager::select('id', 'email')->get();
    }

    public function sheets(): array
    {
        return [
            new Student_sheetImport($this->first_school_id, $this->manager_id)
            // 'Sheet1' => new Student_sheetImport($this->manager_id, $this->first_school_id),
        ];
    }
}

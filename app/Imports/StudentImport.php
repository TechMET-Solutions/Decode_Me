<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    protected $schoolId;

    public function __construct($schoolId)
    {
        $this->schoolId = $schoolId;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $student = User::where('email', $row['email'])->first();
            // return $student;
            if ($student) {
                $student->update([
                    'name' => $row['name'],
                    'mobile' => $row['mobile'],
                    'dob' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']))->format('Y-m-d'),
                    'std' => $row['std'],
                    'enrollDate' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['enrolldate']))->format('Y-m-d'),
                    'motherName' => $row['mothername'],
                    'motherPhone' => $row['motherphone'],
                    'fatherName' => $row['fathername'],
                    'fatherPhone' => $row['fatherphone'],
                    'school_id' => $this->schoolId,
                ]);
            } else {
                User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'mobile' => $row['mobile'],
                    'dob' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']))->format('Y-m-d'),
                    'std' => $row['std'],
                    'school_id' => $this->schoolId,
                    'enrollDate' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['enrolldate']))->format('Y-m-d'),
                    'motherName' => $row['mothername'],
                    'motherPhone' => $row['motherphone'],
                    'fatherName' => $row['fathername'],
                    'fatherPhone' => $row['fatherphone'],
                    'password' => Hash::make($row['password']),
                ]);
            }
        }
    }
}

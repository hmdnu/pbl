<?php

namespace App\Imports;

use App\Models\ProgramStudy;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Student|Model|null
     * @throws Exception
     */
    public function model(array $row): Student|Model|null
    {
        if (
            empty($row['nim']) &&
            empty($row['nama']) &&
            empty($row['email']) &&
            empty($row['tanggal_lulus']) &&
            empty($row['program_studi'])
        ) {
            return null;
        }

        $programStudy = ProgramStudy::where('name', $row['program_studi'])->first();

        if (!$programStudy) {
            throw new Exception("Program Studi '{$row['program_studi']}' tidak ditemukan.");
        }

        return new Student([
            'nim' => $row['nim'],
            'name' => $row['nama'],
            'email' => $row['email'],
            'graduation_date' => Carbon::instance(Date::excelToDateTimeObject($row['tanggal_lulus']))->format('Y-m-d'),
            'program_study_id' => $programStudy->id,
        ]);
    }
}

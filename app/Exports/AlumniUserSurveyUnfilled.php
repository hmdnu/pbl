<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniUserSurveyUnfilled implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return DB::table('alumni_surveys as asy')
            ->leftJoin('alumni_user_surveys as aus', 'asy.student_nim', '=', 'aus.student_nim')
            ->leftJoin('students as s', 'asy.student_nim', '=', 's.nim')
            ->leftJoin('program_studies as ps', 's.program_study_id', '=', 'ps.id')
            ->whereNull('aus.student_nim')
            ->select(
                'asy.supervisor_name',
                'asy.institution_name',
                'asy.supervisor_position',
                'asy.supervisor_email',
                's.name as student_name',
                'ps.name as program_study_name',
                's.graduation_date'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Atasan',
            'Instansi',
            'Jabatan',
            'Email',
            'Nama Mahasiswa',
            'Program Studi',
            'Tahun Lulus',
        ];
    }

    public function map($row): array
    {
        Carbon::setLocale('id');
        return [
            $row->supervisor_name,
            $row->institution_name,
            $row->supervisor_position,
            $row->supervisor_email,
            $row->student_name,
            $row->program_study_name,
            Carbon::parse($row->graduation_date)->translatedFormat('d F Y')
        ];
    }
}

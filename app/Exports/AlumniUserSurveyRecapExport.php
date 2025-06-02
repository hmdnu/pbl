<?php

namespace App\Exports;

use App\Models\AlumniUserSurvey;
use App\Models\ProgramStudy;
use App\Models\AlumniEvaluation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniUserSurveyRecapExport implements FromCollection, WithHeadings, WithMapping
{

    public function collection(): Collection
    {
        return AlumniUserSurvey::with([
            'student.programStudy',
            'alumniEvaluation'
        ])->get();
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->institution_name,
            $row->position,
            $row->email,
            $row->student->name ?? '-',
            $row->student->programStudy->name ?? '-',
            optional($row->student->graduation_date)->format('Y') ?? '-',
            $row->alumniEvaluation->teamwork ?? '-',
            $row->alumniEvaluation->it_expertise ?? '-',
            $row->alumniEvaluation->foreign_language ?? '-',
            $row->alumniEvaluation->communication ?? '-',
            $row->alumniEvaluation->self_development ?? '-',
            $row->alumniEvaluation->leadership ?? '-',
            $row->alumniEvaluation->work_ethic ?? '-',
            $row->alumniEvaluation->unmet_competencies ?? '-',
            $row->curriculum_suggestion,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Instansi',
            'Jabatan',
            'Email',
            'Nama Alumni',
            'Program Studi',
            'Tahun Lulus',
            'Kerjasama Tim',
            'Keahlian di bidang TI',
            'Kemampuan berbahasa asing',
            'Kemampuan berkomunikasi',
            'Pengembangan diri',
            'Kepemimpinan',
            'Etos Kerja',
            'Kompetensi yang dibutuhkan tapi belum dapat dipenuhi',
            'Saran untuk kurikulum program studi'
        ];
    }
}

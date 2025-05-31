<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentSurveyUnfilledExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return Student::With('programStudy')->where('has_filled_survey', false)->get();
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Email',
            'Tanggal Lulus',
            'Program Study'
        ];
    }

    public function map($row): array
    {
        Carbon::setLocale('id');
        return [
            $row->nim,
            $row->name,
            $row->email,
            Carbon::parse($row->graduation_date)->translatedFormat('d F Y'),
            $row->programStudy->name
        ];
    }
}

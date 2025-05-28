<?php

namespace App\Exports;

use App\Models\AlumniSurvey;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniSurveyRecapExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return AlumniSurvey::with([
            'student.programStudy',
            'professionCategory',
            'profession'
        ])->get();
    }

    public function map($row): array
    {
        return [
            $row->student_nim,
            $row->student->name ?? '-',
            $row->student->programStudy->name ?? '-',
            $row->phone,
            $row->email,
            optional($row->student->graduation_date)->format('Y'),
            $row->first_work_date,
            $row->waiting_period,
            $row->first_institution_work_date,
            $row->institution_type,
            $row->institution_name,
            $row->institution_scale,
            $row->institution_location,
            $row->professionCategory->name ?? '-',
            $row->profession->name ?? '-',
            $row->supervisor_name,
            $row->supervisor_position,
            $row->supervisor_email,
        ];
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Program Studi',
            'No Hp',
            'Email',
            'Tahun Lulus',
            'Tanggal Pertama Kali Bekerja',
            'Masa Tunggu',
            'Tanggal Bekerja di Instansi Saat Ini',
            'Jenis Instansi',
            'Nama Instansi',
            'Skala',
            'Lokasi Instansi',
            'Kategori Profesi',
            'Nama Profesi',
            'Nama Atasan Langsung',
            'Jabatan Atasan Langsung',
            'Email Atasan Langsung'
        ];
    }
}

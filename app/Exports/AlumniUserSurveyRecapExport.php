<?php

namespace App\Exports;

use App\Models\AlumniUserSurvey;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlumniUserSurveyRecapExport implements FromCollection
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return AlumniUserSurvey::all();
    }
}

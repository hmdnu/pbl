<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showSpread()
    {
        return view("admin.dashboard.spread");
    }

    public function showEvaluation()
    {
        return view("admin.dashboard.evaluation");
    }

    public function showWaitPeriode()
    {
        return view("admin.dashboard.wait_periode");
    }

    public function showSpreadInstitution()
    {
        return view("admin.dashboard.spread");
    }

    public function spread()
    {
        $total = DB::table('alumni_surveys')->count();

        $rawData = DB::table('alumni_surveys as asy')
            ->join('professions as p', 'asy.profession_id', '=', 'p.id')
            ->select(
                'p.name as profession_name',
                DB::raw("ROUND(COUNT(*) * 100.0 / $total, 2) as percentage")
            )
            ->groupBy('p.name')
            ->orderByDesc('percentage')
            ->get();

        $top10 = $rawData->take(10);
        $othersPercentage = $rawData->slice(10)->sum('percentage');

        $finalData = $top10->toArray();

        if ($othersPercentage > 0) {
            $finalData[] = (object)[
                'profession_name' => 'Lainnya',
                'percentage' => round($othersPercentage, 2)
            ];
        }

        return response()->json($finalData);
    }

    public function getInstitutionTypeSpread()
    {
        $total = DB::table('alumni_surveys')->count();

        $rawData = DB::table('alumni_surveys')
            ->select(
                'institution_type as institution_name',
                DB::raw("ROUND(COUNT(*) * 100.0 / $total, 2) as percentage")
            )
            ->groupBy('institution_type')
            ->orderByDesc('percentage')
            ->get();

        $top10 = $rawData->take(10);
        $othersPercentage = $rawData->slice(10)->sum('percentage');

        $finalData = $top10->toArray();

        if ($othersPercentage > 0) {
            $finalData[] = (object) [
                'institution_name' => 'Lainnya',
                'percentage' => round($othersPercentage, 2)
            ];
        }

        return response()->json($finalData);
    }
    public function waitperiodData()
    {
        $data = DB::table('students as s')
            ->leftJoin('alumni_surveys as asy', 's.nim', '=', 'asy.student_nim')
            ->selectRaw('
            YEAR(s.graduation_date) AS tahun_lulusan,
            COUNT(*) AS jumlah_lulusan,
            COUNT(CASE WHEN s.has_filled_survey = 1 THEN 1 END) AS jumlah_lulusan_yg_terlacak,
            ROUND(COALESCE(AVG(CASE WHEN s.has_filled_survey = 1 THEN asy.waiting_period ELSE NULL END), 0), 2) AS rata2_masa_tunggu
        ')
            ->groupBy(DB::raw('YEAR(s.graduation_date)'))
            ->orderBy(DB::raw('YEAR(s.graduation_date)'), 'asc')
            ->get();

        // return view('dashboard.wait-periode', compact('data'));
        return response()->json($data);
    }
    public function evaluation()
    {
        $columns = [
            'teamwork',
            'it_expertise',
            'foreign_language',
            'communication',
            'self_development',
            'leadership',
            'work_ethic',
        ];

        $result = [];
        foreach ($columns as $col) {
            $result[$col] = $this->getEvaluationData($col);
        }

        return response()->json($result);
    }

    // Helper function evaluation
    private function getEvaluationData($column)
    {
        $labelMap = [
            1 => 'Sangat Baik',
            2 => 'Baik',
            3 => 'Cukup',
            4 => 'Kurang',
        ];

        $data = DB::table('alumni_evaluations')
            ->select($column, DB::raw('COUNT(*) as total'))
            ->groupBy($column)
            ->orderByDesc('total')
            ->get();

        $total = $data->sum('total');

        // label dan persentase
        foreach ($data as $item) {
            $item->label = $labelMap[$item->$column] ?? 'Tidak Diketahui';
            $item->percentage = round(($item->total / $total) * 100, 2);
        }

        $finalData = $data->map(function ($item) {
            return (object) [
                'label' => $item->label,
                'percentage' => $item->percentage,
            ];
        })->toArray();

        return collect($finalData);
    }
}


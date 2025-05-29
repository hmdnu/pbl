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

    public function spread()
    {
        $total = DB::table('alumni_surveys')->count();

        $rawData = DB::table('alumni_surveys as asy')
            ->join('professions as p', 'asy.profession_id', '=', 'p.id')
            ->select(
                'p.name as profession_name',
                DB::raw("ROUND(COUNT(*) * 100.0 / $total) as percentage")
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
                'percentage' => $othersPercentage
            ];
        }

        return response()->json($finalData);
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
            return (object)[
                'label' => $item->label,
                'percentage' => $item->percentage,
            ];
        })->toArray();

        return collect($finalData);
    }
}

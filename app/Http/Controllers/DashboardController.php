<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $finalData[] = (object) [
                'profession_name' => 'Lainnya',
                'percentage' => $othersPercentage
            ];
        }

        return response()->json($finalData);
    }

    public function evaluationTeamwork()
    {
        return $this->getEvaluationData('teamwork');
    }

    public function evaluationItExpertise()
    {
        return $this->getEvaluationData('it_expertise');
    }

    public function evaluationForeignLanguage()
    {
        return $this->getEvaluationData('foreign_language');
    }

    public function evaluationCommunication()
    {
        return $this->getEvaluationData('communication');
    }

    public function evaluationSelfDevelopment()
    {
        return $this->getEvaluationData('self_development');
    }

    public function evaluationLeadership()
    {
        return $this->getEvaluationData('leadership');
    }

    public function evaluationWorkEthic()
    {
        return $this->getEvaluationData('work_ethic');
    }

    public function evaluation()
    {
        return response()->json([
            'teamwork' => $this->evaluationTeamwork()->getData(),
            'it_expertise' => $this->evaluationItExpertise()->getData(),
            'foreign_language' => $this->evaluationForeignLanguage()->getData(),
            'communication' => $this->evaluationCommunication()->getData(),
            'self_development' => $this->evaluationSelfDevelopment()->getData(),
            'leadership' => $this->evaluationLeadership()->getData(),
            'work_ethic' => $this->evaluationWorkEthic()->getData(),
        ]);
    }

    // Helper function
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

        foreach ($data as $item) {
            $item->label = $labelMap[$item->$column] ?? 'Tidak Diketahui';
            $item->percentage = round(($item->total / $total) * 100, 2);
        }


        return response()->json([
            'total' => $total,
            'data' => $data
        ]);
    }
}

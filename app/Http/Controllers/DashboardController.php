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
            $finalData[] = (object) [
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
}

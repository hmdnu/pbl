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

    public function spreadTable()
    {
        $data = DB::table('students', 's')
            ->leftJoin('alumni_surveys AS asy', function ($join) {
                $join->on('s.nim', '=', 'asy.student_nim');
            })
            ->leftJoin('professions AS p', function ($join) {
                $join->on('asy.profession_id', '=', 'p.id');
            })
            ->select([
                DB::raw('YEAR(s.graduation_date) AS tahun_lulusan'),
                DB::raw('COUNT(*) AS jumlah_lulusan'),
                DB::raw('SUM(s.has_filled_survey = 1) AS jumlah_lulusan_yg_terlacak'),
                DB::raw('SUM(s.has_filled_survey = 1 AND p.category_id IS NULL = "Bidang Infokom") AS jumlah_profesi_infokom'),
                DB::raw('SUM(s.has_filled_survey = 1 AND (p.category_id IS NULL OR p.category_id != "Bidang Infokom")) AS jumlah_profesi_non_infokom'),
            ])
            ->groupByRaw('YEAR(s.graduation_date)')
            ->orderByRaw('YEAR(s.graduation_date)')
            ->get();
        return response()->json($data);
    }
}

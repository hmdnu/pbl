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
            $finalData[] = (object) [
                'profession_name' => 'Lainnya',
                'percentage' => $othersPercentage
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showSpread()
    {
        $programs = DB::table('program_studies')->get();
        return view("admin.dashboard.spread", compact('programs'));
    }

    public function showEvaluation()
    {
        $programs = DB::table('program_studies')->get();
        return view("admin.dashboard.evaluation", compact('programs'));
    }

    public function showWaitPeriode()
    {
        return view("admin.dashboard.wait_periode");
    }

    public function showSpreadInstitution()
    {
        return view("admin.dashboard.spread");
    }

    public function spread(Request $request)
    {
        $prodi = $request->input('prodi');
        $tahun = $request->input('tahun');
        $tahunRange = $tahun ? range($tahun - 3, $tahun) : null;

        $query = DB::table('alumni_surveys as asy')
            ->join('students as s', 'asy.student_nim', '=', 's.nim')
            ->join('professions as p', 'asy.profession_id', '=', 'p.id');

        if ($prodi) {
            $query->where('s.program_study_id', $prodi);
        }
        if ($tahunRange) {
            $query->whereIn(DB::raw('LEFT(s.graduation_date, 4)'), $tahunRange);
        }

        $total = $query->count();

        if ($total === 0) {
            return response()->json([]);
        }

        $rawData = $query
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

    public function getInstitutionTypeSpread(Request $request)
    {
        $prodi = $request->input('prodi');
        $tahun = $request->input('tahun');
        $tahunRange = $tahun ? range($tahun - 3, $tahun) : null;

        $query = DB::table('alumni_surveys as asy')
            ->join('students as s', 'asy.student_nim', '=', 's.nim');

        if ($prodi) {
            $query->where('s.program_study_id', $prodi);
        }

        if ($tahunRange) {
            $query->whereIn(DB::raw('LEFT(s.graduation_date, 4)'), $tahunRange);
        }

        $total = $query->count();

        if ($total === 0) {
            return response()->json([]);
        }

        $rawData = $query
            ->select(
                'asy.institution_type as institution_name',
                DB::raw("ROUND(COUNT(*) * 100.0 / $total, 2) as percentage")
            )
            ->groupBy('asy.institution_type')
            ->orderByDesc('percentage')
            ->get();

        $top10 = $rawData->take(10);
        $othersPercentage = $rawData->slice(10)->sum('percentage');

        $finalData = $top10->toArray();
        if ($othersPercentage > 0) {
            $finalData[] = (object)[
                'institution_name' => 'Lainnya',
                'percentage' => round($othersPercentage, 2)
            ];
        }

        return response()->json($finalData);
    }

    public function spreadTable(Request $request)
    {
        $prodi = $request->input('prodi');
        $tahun = $request->input('tahun');
        $tahunRange = $tahun ? range($tahun - 3, $tahun) : null;

        $query = DB::table('students as s')
            ->leftJoin('alumni_surveys AS asy', 's.nim', '=', 'asy.student_nim')
            ->leftJoin('professions AS p', 'asy.profession_id', '=', 'p.id')
            ->leftJoin('alumni_user_surveys AS aus', 's.nim', '=', 'aus.student_nim');

        if ($prodi) {
            $query->where('s.program_study_id', $prodi);
        }

        if ($tahunRange) {
            $query->whereIn(DB::raw('LEFT(s.graduation_date, 4)'), $tahunRange);
        }

        $data = $query
            ->select([
                DB::raw('LEFT(s.graduation_date, 4) AS tahun_lulusan'),
                DB::raw('COUNT(s.nim) AS jumlah_lulusan'),
                DB::raw('SUM(CASE WHEN s.has_filled_survey = 1 THEN 1 ELSE 0 END) AS jumlah_lulusan_yg_terlacak'),
                DB::raw("SUM(CASE WHEN s.has_filled_survey = 1 AND p.category_id = 1 THEN 1 ELSE 0 END) AS jumlah_profesi_infokom"),
                DB::raw("SUM(CASE WHEN s.has_filled_survey = 1 AND (p.category_id IS NULL OR p.category_id != 1) THEN 1 ELSE 0 END) AS jumlah_profesi_non_infokom"),
                DB::raw("SUM(CASE WHEN aus.institution_scale = 'internasional' THEN 1 ELSE 0 END) AS institution_scale_internasional"),
                DB::raw("SUM(CASE WHEN aus.institution_scale = 'nasional' THEN 1 ELSE 0 END) AS institution_scale_nasional"),
                DB::raw("SUM(CASE WHEN aus.institution_scale = 'wirausaha' THEN 1 ELSE 0 END) AS institution_scale_wirausaha")
            ])
            ->groupBy(DB::raw('LEFT(s.graduation_date, 4)'))
            ->orderBy(DB::raw('LEFT(s.graduation_date, 4)'))
            ->get();

        return response()->json($data);
    }


    public function waitPeriodData()
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

        return response()->json($data);
    }

    public function evaluation(Request $request)
    {
        $prodi = $request->input('prodi');
        $tahun = $request->input('tahun');
        $tahunRange = $tahun ? range($tahun - 3, $tahun) : null;

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
            $result[$col] = $this->getEvaluationData($col, $prodi, $tahunRange);
        }

        return response()->json($result);
    }

    // Helper function evaluation
    private function getEvaluationData($column, $prodi = null, $tahunRange = null)
    {
        $labelMap = [
            1 => 'Sangat Baik',
            2 => 'Baik',
            3 => 'Cukup',
            4 => 'Kurang',
        ];

        $query = DB::table('alumni_evaluations as ae')
            ->join('students as s', 'ae.student_nim', '=', 's.nim')
            ->select("ae.$column", DB::raw('COUNT(*) as total'))
            ->groupBy("ae.$column")
            ->orderByDesc('total');

        if ($prodi) {
            $query->where('s.program_study_id', $prodi);
        }
        if ($tahunRange) {
            $query->whereIn(DB::raw('LEFT(s.graduation_date, 4)'), $tahunRange);
        }

        $data = $query->get();
        $total = $data->sum('total');

        foreach ($data as $item) {
            $item->label = $labelMap[$item->$column] ?? 'Tidak Diketahui';
            $item->percentage = $total ? round(($item->total / $total) * 100, 2) : 0;
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

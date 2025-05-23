<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = [
            [
                'title' => 'Data 1',
                'count' => 20
            ],
            [
                'title' => 'Data 2',
                'count' => 10
            ],
            [
                'title' => 'Data 3',
                'count' => 30
            ]
        ];

        return response()->json($data);
    }
}
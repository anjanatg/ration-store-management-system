<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Throwable;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService) 
    {}


    public function index()
{
    $data = $this->dashboardService->DashboardData();
    return view('dashboard.adminpanel', $data);
}
}

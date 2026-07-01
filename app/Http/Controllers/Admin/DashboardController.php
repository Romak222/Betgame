<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard Service
     *
     * @var DashboardService
     */
    protected DashboardService $dashboardService;

    /**
     * Constructor
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display Admin Dashboard.
     */
    public function index(): View
    {
        $dashboardData = $this->dashboardService->getDashboardData();

        return view('admin.dashboard.index', compact('dashboardData'));
    }
}
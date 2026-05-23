<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Exception;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService)
    {}

    public function index(): string
    {
        return view('admin.dashboard')->render();
    }
}

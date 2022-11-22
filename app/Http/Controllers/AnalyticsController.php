<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Widgets\BigNumber;
use LaravelBi\LaravelBi\Filters\DateFilter;
use LaravelBi\LaravelBi\Metrics\CountMetric;

class AnalyticsController extends Controller
{
    public function userAnalysis()
    {

        return view('admin.analytics.index');
    }
}

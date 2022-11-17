<?php

namespace App\Bi\Dashboards;

use LaravelBi\LaravelBi\Dashboard;

class AnalyticsDashboard extends Dashboard
{

    public $model  = AnalyticsModel::class;
    public $uriKey = 'analyticsDashboard';
    public $name   = 'AnalyticsDashboard';

    public function filters()
    {
        return [
            
        ];
    }

    public function widgets()
    {
        return [
            
        ];
    }
}

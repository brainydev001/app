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
    public $model  = User::class;
    public $uriKey = 'users';
    public $name   = 'User dashboard';

    public function filters()
    {
        return [
            DateFilter::create('created_at', 'Created at')
        ];
    }

    public function widgets()
    {
        
        $number = BigNumber::create('user-count', 'Registered users')
            ->metric(
                CountMetric::create('count', 'Count')
                    ->color('#ff5555')
            )
            ->width('1/3');
        
        return view('admin.analytics.index', compact(
            'number'
        ));    
    
    }
}

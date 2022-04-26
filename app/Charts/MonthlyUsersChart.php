<?php

namespace App\Charts;

use App\Models\Idea;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;
    
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Monthly Users')
            ->addData([
            \App\Models\Idea::where('id', '<=', 5)->count(),
            \App\Models\Idea::where('id', '>', 5)->count()
            ])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels(['Active users', 'Inactive users']);
        }
    }
    
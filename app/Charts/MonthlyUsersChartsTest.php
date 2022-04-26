<?php

namespace App\Charts;

use App\Models\Idea;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChartsTest
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \Illuminate\Http\JsonResponse
    {
        return $this->chart->donutChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->addData([
                \App\Models\Idea::where('id', '<=', 5)->pluck('id'),
                \App\Models\Idea::where('id', '>', 5)->pluck('id')
                ])
            ->setLabels(['Player 7', 'Player 10', 'Player 9'])
            ->toJson();
    }
}

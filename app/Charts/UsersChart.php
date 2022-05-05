<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $totalCount = [];
        $day = [];
        $ideas = User::whereMonth('created_at', now()->month)
                    ->orderBy('created_at','asc')
                    ->get()
                    ->groupBy(function($item) {
                        return $item->created_at->format('d');
        });

       foreach($ideas as $key => $idea){
            $day[] = $key;
            $totalCount[] = $idea->count();
        } 
        // dd($day); 
   
        return $this->chart->areaChart()
        ->setHeight(150)
        ->setDataset([
            [
                'name'  =>  'დაემატა',
                'data'  =>  $totalCount
            ]
        ])
        ->setXAxis($day);
    }
    public function Year(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $totalCount = [];
        $day = [];
        $ideas = User::whereYear('created_at', now()->year)
                    ->orderBy('created_at','asc')
                    ->get()
                    ->groupBy(function($item) {
                        return $item->created_at->format('m');
        });

       foreach($ideas as $key => $idea){
            $day[] = $key;
            $totalCount[] = $idea->count();
        } 
        // dd($day); 
   
        return $this->chart->areaChart()
        ->setHeight(150)
        ->setDataset([
            [
                'name'  =>  'დაემატა',
                'data'  =>  $totalCount
            ]
        ])
        ->setXAxis($day);
    }
}

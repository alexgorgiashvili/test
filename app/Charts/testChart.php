<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Idea;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class testChart
{
    protected $chart;
    
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    
    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {

        // $day = [];
        // $totalCount = [];
        $ideas = Idea::whereMonth('created_at', now()->month)
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
}

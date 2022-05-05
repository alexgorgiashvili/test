<?php

namespace App\Charts;

use App\Models\Idea;
use App\Models\Vote;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class VotesChart
{
    protected $chart;
    
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    
    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $totalCount = [];
        $day = [];

        $ideas = Vote::whereMonth('created_at', now()->month)
        ->orderBy('created_at','asc')
        ->get()
        ->groupBy(function($item) {
            return $item->created_at->format('d');
        });
        
        foreach($ideas as $key => $idea){
            $day[] = $key;
            $totalCount[] = $idea->count();
        } 
        //dd($ideas); 
        
        
        return $this->chart->barChart()
        ->setHeight(150)
        ->setDataset([
            [
                'name'  =>  'ხმების ჯამი',
                'data'  =>  $totalCount
            ]
        ])
        ->setXAxis($day);
    }
    public function Year(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $totalCount = [0];
        $day = [];
        $ideas = Vote::whereYear('created_at', now()->year)
        ->orderBy('created_at','asc')
        ->get()
        ->groupBy(function($item) {
            return $item->created_at->format('m');
        });
        
        foreach($ideas as $key => $idea){
            $day[] = $key;
            $totalCount[] = $idea->count();
        } 
        // dd($ideas); 
        
        
        return $this->chart->barChart()
        ->setHeight(150)
        ->setDataset([
            [
                'name'  =>  'ხმების ჯამი',
                'data'  =>  $totalCount
            ]
        ])
        ->setXAxis($day);
    }
}

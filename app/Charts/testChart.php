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
        $month = Carbon::now()->month;
        $currentDay = Idea::whereDay('created_at', now()->day)->count();
        $labels = [];
        $count = [];
        $ideas = Idea::orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('d');
       });
       foreach($ideas as $key => $idea){
        $day = $key;
        $totalCount = $idea->count();
        array_push($count,$totalCount);
    }
    $sm = Idea::whereMonth('created_at', '=', Carbon::now()->month)->get(['created_at']);

      
        // foreach ($ideas as $idea){
        //     array_push($count,$idea->title);
        // }
        // $values = Idea::with('votes' )->get();
        // foreach ($values as $item) {
        //     array_push($count,$item->votes()->count());
        // }
    // dd($count);
       
    $today = today(); 
    $formats = Idea::whereDate('created_at', '<=', $today)->pluck('created_at');
    $dates = []; 
    $count = [];

    // dd(today()->format('d'));
    // for($i=1; $i < today()->format('d') + 1; ++$i) {
    //     $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');

    //     $count[] = $format->where($format, $dates)->count();
        
    // }                                                                                                        
    foreach ($formats as $idea){
        array_push($dates,$idea);

    }
    foreach ($formats as $idea){

        $tst = Idea::whereDay('created_at', $idea);
        array_push($count,$tst);

    }
      



        $mycount = Idea::where('date', $dates)->count();


        return $this->chart->areaChart()
            ->setHeight(150)
            ->addData('Digital sales', [70, 0, 77, 28, 55, 45,88])
            ->setXAxis([]);
    }
}

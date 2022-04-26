<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Idea;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Facades\DB;

class SampleChart extends BaseChart
{ 
    
    
    /**
    * Handles the HTTP request for the given chart.
    * It must always return an instance of Chartisan
    * and never a string or an array.
    */
    public function handler(Request $request): Chartisan
    {
        $ideas = DB::table('ideas')->get();
        $labels = [];
        $count = [];
        foreach ($ideas as $idea){
            array_push($labels,$idea->title);
        }
        $values = Idea::with('votes' )->get();
        foreach ($values as $item) {
            array_push($count,$item->votes()->count());
        }
        return Chartisan::build()
        ->labels($labels)
        ->dataset('Sample',$count );
    }
} 
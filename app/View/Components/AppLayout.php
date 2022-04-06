<?php

namespace App\View\Components;

use App\Models\Idea;
use App\Models\Vote;
use Illuminate\View\Component;

class AppLayout extends Component
{


    
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {   
       
        $surv = Idea::orderByDesc('votes_count')->withCount('votes')->take(20)->get();  
        
        return view('layouts.app',[
            'ideas' => $surv
        ]);
    }
}

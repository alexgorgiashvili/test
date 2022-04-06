<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class TopVoted extends Component
{
    public function render()
    {
        $ideas = Idea::all();
        return view('livewire.top-voted',compact('ideas'));
    }
}

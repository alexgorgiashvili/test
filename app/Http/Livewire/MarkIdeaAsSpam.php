<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;

class MarkIdeaAsSpam extends Component
{
    public $idea;
    public $spamsCount;

                  
    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }
   

    public function markAsSpam()
    {       
            $this->idea->spam(auth()->user());
            
            $this->spamsCount++;
            $this->hasSpammed = true;


             $this->emit('ideaWasSpamed');
    }
   
    // public function render()
    // {
    //     return view('livewire.mark-idea-as-spam');

    // }
    
}

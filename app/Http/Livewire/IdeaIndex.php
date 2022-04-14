<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;

class IdeaIndex extends Component
{
    public $idea;

    

    public function render()
    {
        $val1 = Vote::where('idea_id', $this->idea->id)->where('type', '1')->count();
        $val2 = Vote::where('idea_id', $this->idea->id)->where('type', '2')->count();
        return view('livewire.idea-index', compact('val1', 'val2'));
    }
    
}

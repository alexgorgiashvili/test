<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class MarkIdeaAsNotSpam extends Component
{
    public $idea;
    public function mount( Idea $idea){
        $this->idea = $idea;
    }

    public function markAsNotSpam(){

        $this->idea->spam = 0;
        $this->idea->save();

        $this->emit('ideaSpamCleared');

    }

    public function render()
    {
        return view('livewire.mark-idea-as-not-spam');
    }
}


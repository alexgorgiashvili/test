<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class MarkIdeaAsSpam extends Component
{

    public $idea;

    function mount(Idea $idea){

        $this->idea = $idea;
    }

    public function markAsSpam(){

        if(auth()->guest()){

            abort(403);
        }
        $spam = $this->idea->spam;

        if($spam >= 5){

            Vote::where('idea_id', '=', $this->idea->id)->delete();
            $this->idea->delete();
            return redirect()->route('idea.index');
        }else{
            $this->idea->spam++;
            $this->idea->save();
        }
         
        

        $this->emit('ideaWasSpamed');  
    }

    public function render()
    {
        return view('livewire.mark-idea-as-spam');
    }
}

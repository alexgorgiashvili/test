<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Component;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $votesCount1;
    public $votesCount2;
    public $hasVoted;
    public $hasVotedOne;
    public $hasVotedTwo;
    public $votesCountOne;
    public $votesCountTwo;
    public $status;

    protected $listeners = ['ideaWasUpdated','ideaWasSpamed','ideaSpamCleared'];

    public function mount(Idea $idea, $votesCount)
    {
        $this->status = Status::where('id', '=', $this->idea->status_id )->firstOrFail();

        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
        $this->hasVotedOne = $idea->isVotedOne(auth()->user());
        $this->hasVotedTwo = $idea->isVotedTwo(auth()->user());
    }


    public function ideaWasUpdated()
    {
        $this->idea->refresh();
    }
    public function ideaWasSpamed()
    {
        $this->idea->refresh();
    }
    public function ideaSpamCleared()
    {
        $this->idea->refresh();
    }


    public function voteOne()
    {
        if (! auth()->check()) {
            return $this->emit('notLoggedIn');
        }

        if ($this->hasVotedTwo) {
            $this->idea->removeVoteTwo(auth()->user());
            $this->votesCount--;
            $this->hasVotedTwo = false;
        }

        if ($this->hasVotedOne) {
            $this->idea->removeVoteOne(auth()->user());
            $this->votesCount--;
            $this->hasVotedOne = false;
        } else {
            $this->idea->voteFirst(auth()->user());
            $this->votesCount++;
            $this->hasVotedOne = true;
        }
    }
    public function voteTwo()
    {
        if (! auth()->check()) {
            return $this->emit('notLoggedIn');
        }

        if ($this->hasVotedOne) {
            $this->idea->removeVoteOne(auth()->user());
            $this->votesCount--;
            $this->hasVotedOne = false;
        }

        if ($this->hasVotedTwo) {
            $this->idea->removeVoteTwo(auth()->user());
            $this->votesCount--;
            $this->hasVotedTwo = false;
        } else {

            $this->idea->voteSec(auth()->user());
            $this->votesCount++;
            $this->hasVotedTwo = true;
        }
        // dd($this);
    }
    public function vote()
    {
        if (! auth()->check()) {
            // return redirect(route('login'));
            return $this->emit('notLoggedIn');

        }

        if ($this->hasVoted) {

             $this->idea->removeVote(auth()->user());

            $this->votesCount--;
            $this->hasVoted = false;
        } else {

              $this->idea->vote(auth()->user());

            $this->votesCount++;
            $this->hasVoted = true;
        }
        // dd($this->hasVoted);
    }
    public function render()
    {

        $val1 = Vote::where('idea_id', $this->idea->id)->where('type', '1')->count();
        $val2 = Vote::where('idea_id', $this->idea->id)->where('type', '2')->count();

        $val3 = $val1;
        $val4 = $val2;
        $myval = "";

        if($val3 + $val4 == 0)
        {
            $myval = 0;
            $myval2 = 0;
            return view('livewire.idea-show', compact('val1', 'val2', 'myval', 'myval2'));
        }
        else
        {
            $myval = $val3 / ($val3 + $val4) * 100;
            $myval2 = 100 - $myval;
            $myval = round($myval, 1);
            $myval2 = round($myval2, 1);
            return view('livewire.idea-show', compact('val1', 'val2', 'myval', 'myval2'));
        }

    }
}

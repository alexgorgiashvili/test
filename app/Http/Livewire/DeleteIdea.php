<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class DeleteIdea extends Component
{
    public $idea;
    public $image;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function deleteIdea()
    {
        if (auth()->guest() || auth()->user()->cannot('delete', $this->idea)) {
            abort(403);
        }
        Vote::where('idea_id', $this->idea->id)->delete();
        $path = $this->idea->image;
        $destination = 'storage/images/'.$path;
        // dd($path);

        if(File::exists($destination)){
            File::delete($destination);
        }

        Idea::destroy($this->idea->id);

        return redirect()->route('idea.index');
    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    
    public $filter;
    public $search;

    protected $queryString = [
        'filter',
        'search',
    ];

    


    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter()
    {
        if ($this->filter === 'My Ideas') {
            if (! auth()->check()) {
                return redirect()->route('login');
            }
        }
    }


    public function render()
    {

        return view('livewire.ideas-index', [
            'ideas' => Idea::with('user')
                ->when($this->filter && $this->filter === 'Top Voted', function ($query) {
                    return $query->orderByDesc('votes_count');
                })
                ->when($this->filter && $this->filter === 'My Surveys', function ($query) {
                    return $query->where('user_id', auth()->id());
                })->when($this->filter && $this->filter === 'Spam Surveys', function ($query) {
                    return $query->where('spam', '>', 0)->orderByDesc('spam');
                })->when(strlen($this->search) >= 3, function ($query) {
                    return $query->where('title', 'like', '%'.$this->search.'%');
                })
                // ->addSelect(['voted_by_user' => Vote::select('id')
                //     ->where('user_id', auth()->id())
                //     ->whereColumn('idea_id', 'ideas.id')
                // ])
                ->withCount('votes')
                ->orderBy('id', 'desc')
                ->simplePaginate(12)
                ->withQueryString(),
    
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Redirect;

class Idea extends Model
{
    use HasFactory, Sluggable;
    
    const PAGINATION_COUNT = 10;
    
    protected $guarded = [];
    protected $fillable = ['title', 'description', 'image'];
    
    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
                ]
            ];
        }
        
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        
        
        public function votes()
        {
            return $this->belongsToMany(User::class, 'votes');
        }
        public function spams()
        {
            return $this->belongsToMany(User::class, 'spams');
        }
        
        public function status()
        {
            return $this->belongsTo(Status::class);
        }
        
        public function spam(User $user)
        {
            
            
            Spam::create([
                'idea_id' => $this->id,
                'user_id' => $user->id,
            ]);
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->spams++;
            $idea->save(); 
            
            
            
        }
        
        public function isSpammedByUser(?User $user)
        {
            if(Auth::check())
            {
                return Spam::where('user_id', $user->id)
                ->where('idea_id', $this->id)
                ->exists();
            }
        }
        
        public function isVotedByUser(?User $user)
        {
            if(Auth::check())
            {
                return Vote::where('user_id', $user->id)
                ->where('idea_id', $this->id)
                ->exists();
            }
        }
        public function isVotedOne(?User $user)
        {
            if(Auth::check())
            {
                return Vote::where('user_id', $user->id)
                ->where('idea_id', $this->id)
                ->where('type', 1)
                ->exists();
            }
        }
        public function isVotedTwo(?User $user)
        {
            if(Auth::check())
            {
                return Vote::where('user_id', $user->id)
                ->where('idea_id', $this->id)
                ->where('type', 2)
                ->exists();
            }
        }
        
        public function voteYes(User $user)
        {
            Vote::create([
                'idea_id' => $this->id,
                'user_id' => $user->id,
                'type' => 1
            ]);
            
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes++;
            $idea->save(); 
        }
        public function voteNo(User $user)
        {
            
            Vote::create([
                'idea_id' => $this->id,
                'user_id' => $user->id,
                'type' => 2
            ]);
            
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes++;
            $idea->save(); 
        }

        public function voteFirst(User $user)
        {
            
            Vote::create([
                'idea_id' => $this->id,
                'user_id' => $user->id,
                'type' => 1
            ]);
            
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes++;
            $idea->save(); 
        }
        public function voteSec(User $user)
        {
            
            Vote::create([
                'idea_id' => $this->id,
                'user_id' => $user->id,
                'type' => 2
            ]);
            
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes++;
            $idea->save(); 
        }
        
        public function removeVote(User $user)
        {
            $voteToDelete = Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->first();
            
            if ($voteToDelete) {
                $voteToDelete->delete();
            } 
            
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes--;
            $idea->save(); 
        }
        public function removeVoteOne(User $user)
        {
            $voteToDelete = Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->where('type', 1)
            ->first();
            
            if ($voteToDelete) {
                $voteToDelete->delete();
            } 
            
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes--;
            $idea->save(); 
        }
        public function removeVoteTwo(User $user)
        {
            $voteToDelete = Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->where('type', 2)
            ->first();
            
            if ($voteToDelete) {
                $voteToDelete->delete();
            } 
            $idea = Idea::where('id', $this->id)->firstOrFail();
            $idea->votes--;
            $idea->save(); 
        }
        public function votesCountOne(User $user)
        {
            return Vote::where('user_id', $user->id)
            ->where('idea_id', $this->id)
            ->where('type', 1)
            ->count();
        }
        public function votesCountTwo(User $user)
        {
            return Vote::where('user_id', $user->id)
            ->where('idea_id', $this->id)
            ->where('type', 2)
            ->count();
        }
        
        
    }
    
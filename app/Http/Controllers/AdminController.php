<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function dashboard()
    {
        $ideas = Idea::orderBy('id', 'desc')->paginate(20);      
        return view('admin.dashboard', compact('ideas'));
    }

    public function admin_search(Idea $idea ,Request $request)
    {
        $search = $request->search;
        $searchDate = $request->calendar;
        $searchDateTwo = $request->calendarTwo;

        $orderby = "";
        $orderbywhat = "";

        if($request->top == 0)
        {
            $orderby = 'id';
            $orderbywhat = "desc";
        }
        else if ($request->top == 1)
        {
            $orderby = 'spam';
            $orderbywhat = "desc";
        }
     
        if($request->top == 0)
        {
            if($search != null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                            ->whereBetween('date', [$searchDate, $searchDateTwo])
                            ->orderBy($orderby, $orderbywhat)
                            ->paginate(20);
            }
            if($request->calendar == null && $request->calendarTwo == null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                            ->orderBy($orderby, $orderbywhat)
                            ->paginate(20);
            }
            else 
            {
                $ideas = Idea::whereBetween('date', [$searchDate, $searchDateTwo])
                ->orderBy($orderby, $orderbywhat)
                ->paginate(20);
            }
        }
        else if ($request->top == 1)
        {
            if($search != null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                            ->where('spam','>', 0)
                            ->whereBetween('date', [$searchDate, $searchDateTwo])
                            ->orderBy($orderby, $orderbywhat)
                            ->paginate(20);
            }
            if($request->calendar == null && $request->calendarTwo == null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                            ->where('spam','>', 0)
                            ->orderBy($orderby, $orderbywhat)
                            ->paginate(20);
            }
            else 
            {
                $ideas = Idea::whereBetween('date', [$searchDate, $searchDateTwo])
                ->where('spam','>', 0)
                ->orderBy($orderby, $orderbywhat)
                ->paginate(20);
            }
        }
        else if ($request->top == 2)
        {
            if($search != null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                            ->where('votes','>', 0)
                            ->whereBetween('date', [$searchDate, $searchDateTwo])
                            ->orderBy('votes', 'desc')
                            ->paginate(20);
            }
            if($request->calendar == null && $request->calendarTwo == null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                            ->where('votes','>', 0)
                            ->orderBy('votes', 'desc')
                            ->paginate(20);
            }
            else 
            {
                $ideas = Idea::whereBetween('date', [$searchDate, $searchDateTwo])
                ->where('votes','>', 0)
                ->orderBy('votes', 'desc')
                ->paginate(20);
            }                               
        }
        return view('admin.search', compact('ideas'));

    }
    
    public function view($id) 
    {
        

        $idea = Idea::find($id);
        $status = Status::where('id', $idea->status_id )->firstOrFail();
        $voteOne = Vote::where('idea_id', $idea->id)->where('type', '1')->count();
        $voteTwo = Vote::where('idea_id', $idea->id)->where('type', '2')->count();
        $votesCount = $idea->votes()->count();
        return view('admin.view',[
            'idea' => $idea,
            'status' => $status,
            'voteOne' => $voteOne,
            'voteTwo' => $voteTwo,
            'votesCount' => $votesCount
        ]);
    }

    public function addVotes( User $user ,Request $request, $id)
    {
        
        $voteReq = $request->get('addVotes');
        $chooseVote = $request->get('chooseVote');
        $idea = Idea::find($id);
        $user = Auth::user();

        if($chooseVote == null){
            for ($i = 1; $i <= $voteReq; $i++) 
            {     
                Vote::create([
                    'idea_id' => $idea->id,
                    'user_id' => $user->id,
                    'type' => null
                ]);
            }
        }else{
            if($chooseVote == 1){
                for ($i = 1; $i <= $voteReq; $i++) 
                {     
                    Vote::create([
                        'idea_id' => $idea->id,
                        'user_id' => $user->id,
                        'type' => 1
                        
                    ]);
                }
            }else if ($chooseVote == 2)
            {
                for ($i = 1; $i <= $voteReq; $i++) 
                {          
                    Vote::create([
                        'idea_id' => $idea->id,
                        'user_id' => $user->id,
                        'type' => 2
                    ]);
                }
            }else{
                return redirect()->back()->with('msg','Select Title First');
            }
        }


        
        $ideas = Idea::where('id', $id)->firstOrFail();
        $ideas->votes+=$voteReq;
        $ideas->save();
        return redirect()->back();
    }
    
}

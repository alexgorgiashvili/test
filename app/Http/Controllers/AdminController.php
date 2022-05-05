<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Spam;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Charts\testChart;
use App\Charts\UsersChart;
use App\Charts\votesChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Charts\MonthlyUsersChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    
    public function polls()
    {
        $ideas = Idea::orderBy('id', 'desc')->paginate(20);
        
        
        
        return view('admin.polls', compact('ideas'));
    }
    
    
    
    
    public function dashboard(testChart $chart,votesChart $votes,UsersChart $users)
    {
        // Month Count in Charts
        $currentPolls = Idea::whereMonth('created_at', now()->month)->count();
        $currentVotes = Vote::whereMonth('created_at', now()->month)->count();
        $currentUsers = User::whereMonth('created_at', now()->month)->count();  
        
        // Years Count in Charts
        $currentPollsYear = Idea::whereYear('created_at', now()->year)->count();
        $currentVotesYear = Vote::whereYear('created_at', now()->year)->count();
        $currentUsersYear = User::whereYear('created_at', now()->year)->count();  
        
        
        
        return view('admin.dashboard', [
            
            'chart' => $chart->build(),
            'chartYear' => $chart->Year(),
            'votes' => $votes->build(),
            'votesYear' => $votes->Year(),
            'users' => $users->build(),
            'usersYear' => $users->Year(),
            'currentPolls' => $currentPolls,
            'currentVotes' => $currentVotes,
            'currentUsers' => $currentUsers,
            'currentPollsYear' => $currentPollsYear,
            'currentVotesYear' => $currentVotesYear,
            'currentUsersYear' => $currentUsersYear
            
        ]);
    } 
    
    
    
    public function admin_search(Idea $idea ,Request $request)
    {
        $search = $request->search;
        $searchDate = $request->calendar;
        $searchDateTwo = $request->calendarTwo;
        $top = $request->top;
        $statusCheck = $request->statusCheck;
        $type = $request->type;

        // dd($top);

        
        
        $ideas =Idea::with('votes','user',)
        ->when($top && $search  && $searchDate && $searchDateTwo && $type && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],
                ['idea_type',$request->type],  
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
              ->orderByDesc($request->top);

        })->when( $top && $search  && $searchDate && $searchDateTwo && $type, function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['idea_type',$request->type],  
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
              ->orderByDesc($request->top);

        })->when( $top && $search  && $searchDate && $searchDateTwo &&  $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],  
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
              ->orderByDesc($request->top);

        })->when( $top && $search  && $type && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],
                ['idea_type',$request->type],  
            ])->orderByDesc($request->top);

        })->when($top && $searchDate && $searchDateTwo && $type && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['status',$request->statusCheck],
                ['idea_type',$request->type],       
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
              ->orderByDesc($request->top); 

        })->when( $search && $searchDate && $searchDateTwo && $type && $statusCheck, function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],
                ['idea_type',$request->type],       
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo]); 

        })->when($top && $search && $searchDate && $searchDateTwo  , function ($query) use ($request) {
            return $query->where('title','like','%' . $request->search . '%')
                         ->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
                         ->orderByDesc($request->top);

        })->when($top && $search && $type  , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['idea_type',$request->type],       
            ])->orderByDesc($request->top);

        })->when($top && $search && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],      
            ])->orderByDesc($request->top);

        })->when($top && $searchDate && $searchDateTwo && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['status',$request->statusCheck],      
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
              ->orderByDesc($request->top);

        })->when($top && $searchDate && $searchDateTwo && $type, function ($query) use ($request) {
            return $query->where([
                ['idea_type',$request->type],      
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
              ->orderByDesc($request->top);

        })->when($top && $type && $statusCheck, function ($query) use ($request) {
            return $query->where([
                ['status',$request->statusCheck],  
                ['idea_type',$request->type],      
            ])->orderByDesc($request->top);

        })->when($search && $searchDate && $searchDateTwo && $statusCheck, function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],     
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when($search && $searchDate && $searchDateTwo && $type, function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['idea_type',$request->type],      
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when($searchDate && $searchDateTwo && $type && $statusCheck, function ($query) use ($request) {
            return $query->where([
                ['idea_type',$request->type], 
                ['status',$request->statusCheck],      
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when($top && $search , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],      
            ])->orderByDesc($request->top);

        })->when($top && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['status',$request->statusCheck],       
            ])->orderByDesc($request->top);

        })->when($top && $type , function ($query) use ($request) {
            return $query->where([
                ['idea_type',$request->type],      
            ])->orderByDesc($request->top);

        })->when($top && $searchDate && $searchDateTwo  , function ($query) use ($request) {
            return $query->whereBetween('created_at',[$request->calendar,$request->calendarTwo])
                         ->orderByDesc($request->top);

        })->when($search && $type , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['idea_type',$request->type],       
            ]);

        })->when( $search  && $statusCheck , function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
                ['status',$request->statusCheck],
            ]);

        })->when( $searchDate && $searchDateTwo && $statusCheck , function ($query) use ($request) {
            return $query->where([['status',$request->statusCheck]])
                        ->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when( $searchDate && $searchDateTwo && $type , function ($query) use ($request) {
            return $query->where([
                ['idea_type',$request->type], 
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when( $statusCheck && $type , function ($query) use ($request) {
            return $query->where([
                ['idea_type',$request->type],
                ['status',$request->statusCheck], 
            ])->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when($search, function ($query) use ($request) {
            return $query->where([
                ['title','like','%' . $request->search . '%'],
            ]);

        })->when( $searchDate && $searchDateTwo , function ($query) use ($request) {
            return $query->whereBetween('created_at',[$request->calendar,$request->calendarTwo]);

        })->when($type , function ($query) use ($request) {
            return $query->where([['idea_type',$request->type]]); 

        })->when($statusCheck , function ($query) use ($request) {
            return $query->where([['status',$request->statusCheck]]);
        })->when($top, function ($query) use ($request) {
            return $query->orderByDesc($request->top);
        })
        // ->orderByDesc('id')
        ->get();
  
        
        
        
        
        return view('admin.search', compact('ideas'));
        
    }
    
    public function view($id) 
    {
        
        
        $idea = Idea::find($id);
        $status = Status::where('id', $idea->status_id )->firstOrFail();
        $voteOne = Vote::where('idea_id', $idea->id)->where('type', '1')->count();
        $voteTwo = Vote::where('idea_id', $idea->id)->where('type', '2')->count();
        $votesCount = $idea->votes()->count();
            // dd('wtf');\
            
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
    
    // Edit Ideas
    
    public function edit($id) {
        $idea = Idea::where('id', $id)->firstOrFail();
        return view('admin.edit', compact('idea'));
    }
    
    // Update Ideas
    
    public function admin_update_one(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);
        $oldImg = $idea->image;
        $oldDestination = 'storage/images/'.$oldImg;
        $image = $request->image;
        if($image == null)
        {
            $idea->title = $request->title;
            $idea->description = $request->description;
            $idea->save();
        }
        else{
            File::delete($oldDestination);
            
            $name = $image->getClientOriginalName();
            $input['image'] = time().'.'.$name;
            $destinationPath = public_path('storage/images');
            $pathname = $destinationPath.'/'.$input['image'];
            Image::make($image->getRealPath())
            ->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathname);
            $idea->image = $input['image'];
            $idea->title = $request->title;
            $idea->description = $request->description;
            $idea->save();
        }
        
        
        return redirect()->route('admin_view',$id)->with('success', 'გამოკითხვა წარმატებით დარედაქტირდა');
    }
    
    
    public function admin_update_two(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);
        $oldImg = $idea->image;
        $oldImgSec = $idea->image_second;
        $oldDestination = 'storage/images/'.$oldImg;
        $oldDestinationSec = 'storage/images/'.$oldImgSec;
        
        $image = $request->image;
        $imagetwo = $request->imagetwo;
        if($image == null && $imagetwo == null)
        {
            $idea->title = $request->title;
            $idea->description = $request->description;
            $idea->title_second = $request->titletwo;
            $idea->save();
        }
        elseif($image == null && $imagetwo != null)
        {
            File::delete($oldDestinationSec);
            
            $nametwo = $imagetwo->getClientOriginalName();
            $input['imagetwo'] = time().'.'.$nametwo;
            $destinationPath = public_path('storage/images');
            $pathname = $destinationPath.'/'.$input['imagetwo'];
            Image::make($imagetwo->getRealPath())
            ->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathname);
            $idea->image_second = $input['imagetwo'];
            $idea->title = $request->title;
            $idea->title_second = $request->titletwo;
            $idea->description = $request->description;
            $idea->save();
        }
        elseif($image != null && $imagetwo == null)
        {
            File::delete($oldDestination);
            
            $name = $image->getClientOriginalName();
            $input['image'] = time().'.'.$name;
            $destinationPath = public_path('storage/images');
            $pathname = $destinationPath.'/'.$input['image'];
            Image::make($image->getRealPath())
            ->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathname);
            $idea->image = $input['image'];
            $idea->title_second = $request->titletwo;
            $idea->title = $request->title;
            $idea->description = $request->description;
            $idea->save();
        }
        else
        {
            
            File::delete($oldDestinationSec,$oldDestination);
            $nametwo = $imagetwo->getClientOriginalName();
            $input['imagetwo'] = time().'.'.$nametwo;
            $destinationPath = public_path('storage/images');
            $pathnameTwo = $destinationPath.'/'.$input['imagetwo'];
            Image::make($imagetwo->getRealPath())
            ->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathnameTwo);
            //
            
            $name = $image->getClientOriginalName();
            $input['image'] = time().'.'.$name;
            $destinationPath = public_path('storage/images');
            $pathname = $destinationPath.'/'.$input['image'];
            Image::make($image->getRealPath())
            ->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathname);
            $idea->image = $input['image'];
            $idea->image_second = $input['imagetwo'];
            $idea->title = $request->title;
            $idea->title_second = $request->titletwo;
            $idea->description = $request->description;
            $idea->save();
            if(File::exists($oldDestination,$oldDestinationSec)) {
                File::delete($oldDestination,$oldDestinationSec);
            }
            
        }   
        
        
        return redirect()->route('admin_view',$id)->with('success', 'გამოკითხვა წარმატებით დარედაქტირდა');
    }
    
    
    // Delete Ideas
    
    public function delete($id) {
        
        $idea = Idea::find($id);
        $path = $idea->image;
        $pathTwo = $idea->image_second;
        $destination = 'storage/images/'.$path;
        $destinationTwo = 'storage/images/'.$pathTwo;
        Vote::where('idea_id',$id)->delete();
        Spam::where('idea_id',$id)->delete();
        Status::where('id',$id)->delete();
        
        
        if(File::exists($destinationTwo)){
            File::delete($destination,$destinationTwo);
        }else{
            File::delete($destination);
        }
        
        Idea::destroy($id);
        
        return redirect()->route('admin_polls');
    }
    
    // Clear Spams
    
    public function clearSpams($id){
        $idea = Idea::find($id);
        Spam::where('idea_id',$id)->delete();
        $idea->spams = 0;
        $idea->save();
        return redirect()->route('admin_view',$id);
    }
    
}

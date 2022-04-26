<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Spam;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Charts\testChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Charts\MonthlyUsersChart;
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
    
    
    
    
    public function dashboard(testChart $chart)
    {
        $month = Carbon::now()->month;
        $currentMonth = Idea::whereMonth('created_at', now()->month)->count();
        $sms = Idea::whereMonth('created_at', '=', Carbon::now()->month)->get();

        // $tst = [];
        //  foreach ($sms as $sm){
        //     array_push($tst,$sm->count());
        // }
        // dd($tst);
        
        return view('admin.dashboard', [
            
            'chart' => $chart->build(),
            'currentMonth' => $currentMonth
            
        ]);
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
            $orderby = 'spams';
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
                ->where('spams','>', 0)
                ->whereBetween('date', [$searchDate, $searchDateTwo])
                ->orderBy($orderby, $orderbywhat)
                ->paginate(20);
            }
            if($request->calendar == null && $request->calendarTwo == null)
            {
                $ideas = Idea::where('title','like','%'.$search.'%')
                ->where('spams','>', 0)
                ->orderBy($orderby, $orderbywhat)
                ->paginate(20);
            }
            else 
            {
                $ideas = Idea::whereBetween('date', [$searchDate, $searchDateTwo])
                ->where('spams','>', 0)
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

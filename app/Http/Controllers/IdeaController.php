<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;

class IdeaController extends Controller
{

    public function index()
    {
        return view('idea.index');
    }

    public function create()
    {
        return view('idea.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $val = $request->validate([
            'title' => 'required|min:4|max:40',
            'description' => 'required|min:4',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:3072',

        ]);

        $ident = Idea::where('title', '=', $request->title)->first();


        if($ident){
            $id = $ident->slug;
            return redirect()->route('idea.show', $id);
        }

        $image = $request->image;
        $name = $image->getClientOriginalName();
        $input['image'] = time().'.'.$name;

        $destinationPath = public_path('storage/images');

        Image::make($image->getRealPath())
        
                ->resize(500, 500, function ($constraint) {
		            $constraint->aspectRatio();
		       })->save($destinationPath.'/'.$input['image']);
        
        $status = new Status;
        $status->name = 'Open';
        $status->save();
        
        $survey = new Idea;
        $survey->title = $request->title;
        $survey->idea_type = 1;
        $survey->status_id = $status->id;
        $survey->votes = 0;
        $survey->user_id = auth()->id();
        $survey->description = $request->description;
        $survey->date = Date('Y-m-d');
        $survey->hide_name = $request->hide_name;
        $survey->image = $input['image'];
        $survey->save();

        
        

        return redirect()->route('idea.index')->with('Sucess', 'წარმატებით დაემატა');

    }

    public function storeTwo(Request $request){
        // $request->validate([
        //     'title1' => 'required|min:4|max:40',
        //     'title2' => 'required|min:4|max:40',
        //     'description' => 'required|min:4',
        //     'imageone' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:3072',
        //     'imagetwo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:3072',
        // ]);

        $ident = Idea::where('title', '=', $request->title1)->first();

        if($ident){
            $id = $ident->slug;
            return redirect()->route('idea.show', $id);
        }
        // dd($request);
        $imageone = $request->image;
        $name = $imageone->getClientOriginalName();
        $input['image'] = time().'.'.$name;

        $destinationPath = public_path('storage/images');

        Image::make($imageone->getRealPath())
                ->resize(500, 500, function ($constraint) {
		            $constraint->aspectRatio();
		       })->save($destinationPath.'/'.$input['image']);



        $imagetwo = $request->imagetwo;
        $name = $imagetwo->getClientOriginalName();
        $input['imagetwo'] = time().'.'.$name;

        $destinationPath = public_path('storage/images');

        Image::make($imagetwo->getRealPath())
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagetwo']);

            $status = new Status;
            $status->name = 'Open';
            $status->save();

            $survey = new Idea;
            $survey->title = $request->title;
            $survey->title_second = $request->titletwo;
            $survey->status_id = $status->id;
            $survey->user_id = auth()->id();
            $survey->idea_type = 2;
            $survey->description = $request->description;
            $survey->hide_name = $request->hide_name;
            $survey->date = Date('Y-m-d');
            $survey->image = $input['image'];
            $survey->image_second = $input['imagetwo'];
            $survey->votes = 0;
            $survey->save();

        return redirect()->route('idea.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
       $votesCount1 = Vote::where('type',  '1')->count();
       $votesCount2 = Vote::where('type',  '2')->count();
        return view('idea.show', [
            
            'idea' => $idea,
            'votesCount' => $idea->votes()->count(),
            'votesCount1' => $votesCount1,
            'votesCount2' => $votesCount2,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit_idea($id)
    {
        $idea = Idea::where('id', $id)->firstOrFail();
        return view('idea.edit', compact('idea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update_one(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);
        
        $image = $request->image;
        if($image == null)
        {
            $idea->title = $request->title;
            $idea->description = $request->description;
            $idea->save();
        }
        else{
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


        return redirect()->route('idea.index')->with('success', 'გამოკითხვა წარმატებით დარედაქტირდა');
    }


    public function update_two(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);
        
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
            $nametwo = $imagetwo->getClientOriginalName();
            $input['imagetwo'] = time().'.'.$nametwo;
            $destinationPath = public_path('storage/images');
            $pathname = $destinationPath.'/'.$input['imagetwo'];
            Image::make($imagetwo->getRealPath())
            ->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
           })->save($pathname);
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
            $idea->title = $request->title;
            $idea->title_second = $request->titletwo;
            $idea->description = $request->description;
            $idea->save();
        }


        return redirect()->route('idea.index')->with('success', 'გამოკითხვა წარმატებით დარედაქტირდა');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }
}

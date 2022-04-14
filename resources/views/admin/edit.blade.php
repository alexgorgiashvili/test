@extends('admin.layouts.app')
@section('content')


<div class="container-fluid position-relative px-0 pt-md-3 pt-1">
    @if($idea->idea_type == 1)
    <div class="col position-absolute w-100 pollone">
        <form action="{{ route('admin_update_one', $idea->id) }}" class="add-form " method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="title" class="form-label">Add Poll </label>
                <input type="text" value="{{ $idea->title }}" name="title" class="form-control geo-input" id="geo_inp" ondragstart="return false;" ondrop="return false;" onpaste="return false" >
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p class="text-danger geo_key"></p>
            </div>
            <div class="form-floating mb-3">
                <textarea data-gramm="false" name="description" class="form-control txt-area p-2 geo-input" id="geo_inp2" type="text"  maxlength="100">{{  $idea->description }}</textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p class="text-danger geo_key_area"></p>
            </div>
            
            <input name="image" class="form-control" type="file">
            <div class="form-check pt-3">
                {{-- <input  wire:model.defer='hide_name' name='hide_name' type="hidden" value="1" > --}}
                <input class="form-check-input no-focus cursor-pointer" wire:model.defer='hide_name' name='hide_name' type="checkbox" value="1"  >
                <label class="form-check-label" >
                    Check For Hide Name
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-2 d-block ms-auto">Add</button>
        </form>
    </div>
    @endif
    @if($idea->idea_type == 2)
    <div class="col position-absolute w-100 ">
        <form  class="add-form "action="{{ route('admin_update_two',$idea->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            
            <div class="mb-3">
                <label for="title" class="form-label">Edit Poll </label>
                <input type="text" value="{{ $idea->title }}" name="title" class="form-control geo-input" id="geo_inp" ondragstart="return false;" ondrop="return false;" onpaste="return false" >
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p class="text-danger geo_key"></p>
            </div>
            <div class="mb-3">
                <input type="text" value="{{ $idea->title_second }}" name="titletwo" class="form-control geo-input" id="geo_inp3" ondragstart="return false;" ondrop="return false;" onpaste="return false" >
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p class="text-danger geo_key"></p>
            </div>
            <div class="form-floating mb-3">
                <textarea data-gramm="false" name="description" class="form-control txt-area p-2 geo-input" id="geo_inp2" type="text"  maxlength="100">{{  $idea->description }}</textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
          
            
            <input name="image" class="form-control" type="file">
            
            <input name="imagetwo" class="form-control mt-2" type="file">
            
            
            <div class="form-check pt-3">
                <input class="form-check-input no-focus cursor-pointer"  name='hide_name' type="checkbox" value="1"  >
                <label class="form-check-label" >
                    Check For Hide Name
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary mt-2 d-block ms-auto">Add</button>
            
            
            
        </form>
    </div>
    @endif
    
</div>







@endsection
@extends('admin.layouts.app')
@section('content')

@forelse ($ideas as $idea)
@if($idea->idea_type == 1)
<div class="col-lg-4 crd">
    <div class="row crd-row g-0 border rounded overflow-hidden flex-lg-column flex-row mb-4 shadow-sm h-md-250 ">
        <div class="  col-4  col-lg-12 crd-head">
            <div class="h-100 d-flex">
                <a class="w-100" href="{{ url('storage/images',$idea->image ) }}"data-lightbox="image-{{ $idea->id }}" >
                    <img class='index-image w-100 'src="{{ url('storage/images',$idea->image ) }}" alt="">
                </a>
            </div>
        </div>
        <div class=" col-8 col-lg-12 p-2 p-sm-4 d-flex flex-column position-static crd-body">
            <a href="{{ route('admin_view',$idea) }}" class="mb-0 fw-bold text-dark text-decoration-none crd-title-a">{{ $idea->title }}</a>
            <p class="card-text crd-text  pt-3 mb-auto" >{{ $idea->description }}</p>
            <div class="d-flex justify-content-between mt-4">
                <ul class="ps-0 mb-0 comment-ul">
                    <li class="list-unstyled text-danger pe-4">Spams:{{ $idea->spams}}</li>
                    <li class="list-unstyled text-primary pe-4">Votes:{{ $idea->votes}}</li>
                    <li class="list-unstyled text-secondary pe-4">Status: <span class="text-success @if($idea->status != 'Open') text-red @endif">{{  $idea->status }}</span> </li>
                    <li class="list-unstyled text-secondary pe-4">{{ $idea->created_at->diffForHumans() }}</li>
                    
                </ul>
                <div class="mt-auto">
                    <a href="{{ route('admin_view',$idea) }}" class="btn btn-dark ">Open</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endif


@if($idea->idea_type == 2)
<div class="col-lg-4 crd">
    <div class="row crd-row g-0 border rounded overflow-hidden flex-lg-column flex-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="  col-4  col-lg-12 crd-head position-relative">
            <div class="h-100 d-flex img_vs">
                <a class="w-50 img-border-left" href="{{ url('storage/images',$idea->image ) }}"data-lightbox="image-{{ $idea->id }}" >
                    <img class='index-image w-100 ' src="{{ url('storage/images',$idea->image ) }}" alt="">
                </a>
                <a class="w-50 img-border-right" href="{{ url('storage/images',$idea->image_second ) }}"data-lightbox="image-{{ $idea->id }}" >
                    <img class='index-image w-100 ' src="{{ url('storage/images',$idea->image_second ) }}" alt="">
                </a>
            </div>
        </div>
        <div class=" col-8 col-lg-12 p-2 p-sm-4 d-flex flex-column position-static crd-body">
            <a href="{{ route('admin_view',$idea) }}" class="mb-0 fw-bold text-dark text-decoration-none crd-title-a">{{ $idea->title }} vs {{ $idea->title_second }}</a>
            <p class="card-text crd-text  pt-3 mb-auto" >{{ $idea->description }}</p>
            
            
            <div class="d-flex justify-content-between mt-4">
                <ul class="ps-0 mb-0 comment-ul">
                    <li class="list-unstyled text-danger pe-4">Spams:{{ $idea->spams }}</li>
                    <li class="list-unstyled text-primary pe-4">Votes:{{ $idea->votes }}</li>
                    <li class="list-unstyled text-secondary pe-4">Status: <span class="text-success @if($idea->status != 'Open') text-red @endif">{{  $idea->status }}</span> </li>

                    <li class="list-unstyled text-secondary pe-4">{{ $idea->created_at->diffForHumans() }}</li>
                   
                    
                    
                </ul>
                <div class="mt-auto">
                    <a href="{{ route('admin_view',$idea) }}" class="btn btn-dark ">Open</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endif
@empty
<p class="fw-bold text-red">No Polls were found...</p>

@endforelse

@endsection
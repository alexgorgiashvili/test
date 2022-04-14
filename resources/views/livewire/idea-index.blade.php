@if($idea->idea_type == 1)
<div class="col-lg-4 crd" onclick="location.href='{{ route('idea.show',$idea) }}';" style="cursor: pointer;">
    <div class="row crd-row g-0 border rounded overflow-hidden flex-lg-column flex-row mb-4 shadow-sm h-md-250 ">
        <div class="  col-4  col-lg-12 crd-head">
            <div class="h-100 d-flex">
                <a class="w-100" href="{{ route('idea.show',$idea) }}" >
                    <img class='index-image w-100 'src="{{ url('storage/images',$idea->image ) }}" alt="">
                </a>
            </div>
        </div>
        <div class=" col-8 col-lg-12 p-2 p-sm-4 d-flex flex-column position-static crd-body">
            <a href="{{ route('idea.show',$idea) }}" class="mb-0 fw-bold text-dark text-decoration-none crd-title-a">{{ $idea->title }}</a>
            <div class="d-flex justify-content-between">
                <div class="votes-div">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endif


@if($idea->idea_type == 2)
<div class="col-lg-4 crd" onclick="location.href='{{ route('idea.show',$idea) }}';" style="cursor: pointer;">
    <div class="row crd-row g-0 border rounded overflow-hidden flex-lg-column flex-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="  col-4  col-lg-12 crd-head position-relative">
            <div class="h-100 d-flex img_vs">
                <a class="w-50 img-border-left" href="{{ route('idea.show',$idea) }}" >
                    <img class='index-image w-100 ' src="{{ url('storage/images',$idea->image ) }}" alt="">
                </a>
                <a class="w-50 img-border-right" href="{{ route('idea.show',$idea) }}" >
                    <img class='index-image w-100 ' src="{{ url('storage/images',$idea->image_second ) }}" alt="">
                </a>
            </div>
        </div>
        <div class=" col-8 col-lg-12 p-2 p-sm-4 d-flex flex-column position-static crd-body">
            <a href="{{ route('idea.show',$idea) }}" class="mb-0 fw-bold text-dark text-decoration-none crd-title-a">{{ $idea->title }} vs {{ $idea->title_second }}</a>
            <div class="d-flex justify-content-between">
                <div class="votes-div">
                    
                    <div class="d-flex justify-content-between">
                        
                    </div>
                </div>
                <div class="votes-div">
                    
                    <div class="d-flex justify-content-between">
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endif

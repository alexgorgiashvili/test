@extends('admin.layouts.app')
@section('content')
  <div class="container w-100 m-auto pt-5">
    <a class="d-flex" href="{{ route('admin_dashboard') }}">
      <i class="bi bi-backspace-fill text-primary d-flex pt-1"></i>
      <p class="text-primary ">Back</p>
    </a>
@if($idea->idea_type == 1)
<div class="show-ideas-container">

    <div class="col">
        <div class="row g-0 border rounded  flex-lg-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col-4 crd-head ">
                <div class="h-100 d-flex" >
                    <a class="w-100" href="{{ url('storage/images',$idea->image ) }}"data-lightbox="image-{{ $idea->id }}" >
                        <img class='index-image w-100 h-100 'src="{{ url('storage/images',$idea->image ) }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-8 p-2 p-sm-4 d-flex flex-column position-relative crd-body">
                @if ($status->name == 'Open')
                <div class='position-absolute status-btn'>
                    <button class="btn btn-success rounded-pill disabled">{{ $status->name }}</button>
                </div>
                @else
                <div class='position-absolute status-btn'>
                    <button class="btn btn-danger rounded-pill disabled">{{ $status->name }}</button>
                </div>
                @endif

                <h3 class="mb-0">{{ $idea->title }}</h3>
                <h3 class="mb-0">{{ $idea->title_second }}</h3>

                <p class="card-text crd-text pt-3 mb-auto">{{ $idea->description }}</p>

                @if($idea->spam > 0)

                    <p class="text-danger bounceInDown">Spam Reports:{{ $idea->spam }}</p>

                @endif
                @if($idea->votes()->count() > 0)

                    <p class="text-primary bounceInDown">Votes:{{ $idea->votes()->count() }}</p>

                @endif

                <div class="d-flex justify-content-between mt-4">
                    <ul class="d-md-flex ps-0 mb-0">
                        @if($idea->hide_name == null || $idea->hide_name == 0)
                        <li class="list-unstyled fw-bold pe-3">{{ $idea->user->name }}</li>

                        @endif

                        <li class="list-unstyled text-secondary pe-3">{{ $idea->created_at->diffForHumans() }}</li>



                    </ul>

                    @auth
                    <div class='edit-btns d-flex' x-data>

                        @can('update', $idea)
                        <a href="{{ route('edit_idea',$idea->id) }}"
                            class="btn btn-secondary">Edit</a>
                            @endcan
                            <div class="dropdown ms-1">
                                <button class="btn bg-black text-white dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu
                                </button>
                                <ul class="dropdown-menu spam-dropdown" aria-labelledby="dropdownMenuButton1">
                                    @can('delete', $idea)
                                    <li class="dropdown-item"><button class=" btn"
                                        @click="$dispatch('custom-show-delete-modal')"
                                        >Delete</button>
                                    </li>
                                    @endcan
                                    <li class="dropdown-item"><button class=" btn"
                                        @click="$dispatch('custom-show-spam-modal')"
                                        >Mark As Spam</button>
                                    </li>
                                    @admin
                                    <li class="dropdown-item"><button class=" btn"
                                        @click="$dispatch('custom-show-clear-spam-modal')"
                                        >Clear Spam</button>
                                    </li>
                                    @endadmin
                                </ul>
                            </div>


                        </div>
                        @endauth



                    </div>
                </div>

            </div>
        </div>

    </div>
    @endif
    @if($idea->idea_type == 2)
    <div class="show-ideas-container">

        <div class="col">
            <div class="row g-0 border rounded  flex-lg-row shadow-sm h-md-250 position-relative">
                
                <div class="col-4 crd-head crd-imgtwo  position-relative">
                    <div class="h-100 img_vs" >
                        <a class="w-100  " href="{{ url('storage/images',$idea->image ) }}"data-lightbox="image-{{ $idea->id }}" >
                            <img class='h-50 index-image w-100  img-border-bottom' src="{{ url('storage/images',$idea->image ) }}" alt="">
                        </a>
                        <a class="w-100 " href="{{ url('storage/images',$idea->image_second ) }}"data-lightbox="image-{{ $idea->id }}" >
                            <img class='h-50 index-image w-100  img-border-top' src="{{ url('storage/images',$idea->image_second ) }}" alt="">
                        </a>

                    </div>
                </div>
                <div class="col-4  d-flex flex-column position-relative crd-body crd-body-border">

                    <div class="votes-div h-50 p-3">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <h4>{{ $idea->title }}  </h4>


                           <div class="d-flex justify-content-between">
                            <b class="text-primary pt-2" >Votes:<span class="text-dark">{{ $voteOne}}</span></b>
                             
                           </div>

                        </div>

                    </div>
               

                <div class="votes-div h-50 p-3">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <h4 class="mt-3">{{ $idea->title_second }}  </h4>
                        <div class="d-flex justify-content-between">
                            <b class="text-primary pt-2" >Votes:<span class="text-dark">{{ $voteTwo}}</span></b>
                        @if($idea->spam > 0)
                            <b class="text-danger pt-2">Spams:<span class="text-dark">{{ $idea->spam }}</span></b>
                        @endif
                        @if($status->name == 'Open')
                            <span class="btn rounded-pill  btn-success disabled">{{ $status->name}}</span>
                        @else
                            <span class="btn rounded-pill btn-danger disabled">{{ $status->name}}</span>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 crd-body">
            <div class="d-flex flex-column h-100">
                <div class=" h-75">
                    <p class="card-text crd-text  p-3 mb-auto" >{{ $idea->description }}</p>
                </div>
                <div class=" h-25 d-flex align-items-end">
                    <div class="d-flex justify-content-between w-100 p-3 ">
                        <ul class="ps-0 mb-0 comment-ul d-flex">
                            <li class="list-unstyled text-secondary pt-1 data-ago">{{ $idea->created_at->diffForHumans() }}</li>


                        </ul>
                        @auth
                        <div class='edit-btns d-flex' x-data>

                            @can('update', $idea)
                            <a href="{{ route('edit_idea',$idea->id) }}"
                                class="btn btn-secondary">Edit</a>
                                @endcan


                                <div class="dropdown ms-1">
                                    <button class="btn bg-black text-white dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Menu
                                    </button>
                                    <ul class="dropdown-menu spam-dropdown" aria-labelledby="dropdownMenuButton1">
                                        @can('delete', $idea)
                                        <li class="dropdown-item"><button class=" btn"
                                            @click="$dispatch('custom-show-delete-modal')"
                                            >Delete</button>
                                        </li>
                                        @endcan
                                        <li class="dropdown-item"><button class=" btn"
                                            @click="$dispatch('custom-show-spam-modal')"
                                            >Mark As Spam</button>
                                        </li>
                                        @admin
                                        <li class="dropdown-item"><button class=" btn"
                                            @click="$dispatch('custom-show-clear-spam-modal')"
                                            >Clear Spam</button>
                                        </li>
                                        @endadmin
                                    </ul>
                                </div>


                            </div>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
    @if($idea->hide_name == null || $idea->hide_name == 0)
    <span class=" fw-bold text-secondary ps-2">Posted By {{ $idea->user->name }}</span>
    @endif
</div>
@endif

    <form action="{{ route('admin_addVotes',$idea->id) }}" method="GET" class="mt-2">
      @if($idea->idea_type == 2)
        <select name="chooseVote" class="form-select no-focus cursor-pointer" aria-label="Default select example">
          <option value="0" selected>Choose</option>
          <option value="1">{{ $idea->title }} </option>
          <option value="2">{{ $idea->title_second }} </option>
        </select>
      @endif
      @if (Session::has('msg'))
        <div class="alert alert-danger" role="alert">
          <span><i class="bi bi-arrow-up"></i></span>   {{ Session::get('msg') }}
        </div>
      @endif
      <div class="form-group pt-2">
        <label for="exampleInputPassword1">AddVotes</label>
        <input type="number" name="addVotes" class="form-control my-2" id="exampleInputPassword1" placeholder="AddVotes">
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
    </form>
  </div>

@endsection
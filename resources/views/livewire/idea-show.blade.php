@if($idea->idea_type == 1)
<div class="show-ideas-container"
>

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
                    <button class="btn btn-success rounded-pill disabled">აქტიური</button>
                </div>
                @else
                <div class='position-absolute status-btn'>
                    <button class="btn btn-danger rounded-pill disabled">დასრულებული</button>
                </div>
                @endif
                

                <h3 class="mb-0">{{ $idea->title }}</h3>
                <h3 class="mb-0">{{ $idea->title_second }}</h3>

                <p class="card-text crd-text pt-3 mb-auto">{{ $idea->description }}</p>

                @if($spam > 0)

                    <p class="text-danger bounceInDown">Spam Reports:{{ $spam }}</p>

                @endif

                <div class="votes-div">
                    {{-- <p class=" m-0 py-2 fw-bold @if  ( $hasVoted )  text-red @endif"> {{ $val1 }}</p>
                    <p class=" m-0 py-2 fw-bold @if  ( $hasVoted )  text-red @endif"> {{ $val2 }}</p> --}}
                    @if ($status->name == 'Open')
                        @if ($hasVoted)
                         <p class=" m-0 py-2 fw-bold @if  ( $hasVoted )  text-red @endif"><b class="text-black">პიტალოა</b>-{{ $val1 }}</p>
                         <p class=" m-0 py-2 fw-bold @if  ( $hasVoted )  text-red @endif"><b class="text-black">ოქროა</b>-{{ $val2 }}</p>
                        @else
                        <button wire:click="voteYes" type="button" class="btn btn-success" >კი,პიტალოა</button>
                        <button wire:click="voteNo" type="button" class="btn btn-danger" >არა,არ არის პიტალო</button>



                        @endif
                    @else
                   
                    @endif


                </div>

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
                            <div class="dropdown ms-1 @if($hasSpammed)d-none @endif"x-data>
                                <button
                                x-cloak
                                 x-data="{ isOpen: true }"
                                 x-show="isOpen"
                                 x-init="
                                     window.livewire.on('ideaWasSpamed',() => {
                                         isOpen = false
                                     })
                                 "
                                class="btn bg-black text-white dropdown-toggle " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    მენიუ
                                </button>
                                <ul class="dropdown-menu spam-dropdown " aria-labelledby="dropdownMenuButton1">
                                
                                    @can('delete', $idea)
                                    <li class="dropdown-item">
                                        <button class=" btn"@click="$dispatch('custom-show-delete-modal')">Delete</button>
                                    </li>
                                    @endcan
                                    @if($hasSpammed == false)
                                        
                                        <li class="dropdown-item">
                                            <button class=" btn"@click="$dispatch('custom-show-spam-modal')">დარეპორტება</button>
                                        </li>
                                       
                                    @endif
                                    @admin
                                    <li class="dropdown-item">
                                        <button class=" btn"@click="$dispatch('custom-show-clear-spam-modal')">Clear Spam</button>
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
                            <h6>{{ $idea->title }}  </h6>


                            @if ($status->name == 'Open')
                                @if($hasVotedOne || $hasVotedTwo)

                                @else
                                <button wire:click.prevent='voteOne' type="button"
                                class="btn w-25 btn-secondary  @if ($hasVotedOne) bg-dark @endif" >Vote
                                </button>
                                @endif
                            @endif

                        </div>

                    </div>
                @if($hasVotedOne || $hasVotedTwo)
                    <p class="mb-1 ps-2 text-black">Votes: {{ $val1 }}</p>
                    <div class="progress mx-1 ">
                        @if($votesCount == 0)
                        <p class="text-black mx-auto">No Votes </p>
                        @else
                        <div class="progress-bar bg-dark progress-bar-striped" role="progressbar" style="width: {{ $myval }}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">{{ $myval }}%</div>
                        <div class="progress-bar bg-red progress-bar-striped" role="progressbar" style="width: {{ $myval2 }}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">{{ $myval2 }}%</div>
                        @endif
                    </div>
                    <p class="mt-1 ps-2 text-black mb-0">Votes: {{ $val2 }}</p>
                @endif

                <div class="votes-div h-50 p-3">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <h6 class="">{{ $idea->title_second }}  </h6>
                        <div class="d-flex justify-content-between">


                            @if ($status->name == 'Open')
                                @if($hasVotedOne || $hasVotedTwo)

                                @else
                                    <button wire:click.prevent='voteTwo' type="button"
                                    class="btn w-25 btn-secondary @if ($hasVotedTwo) bg-red @endif" >Vote
                                    </button>
                                @endif
                            @else
                            <div class=''>
                                <button class="btn btn-danger rounded-pill disabled">{{ $status->name }}</button>
                            </div>
                            @endif

                            @if($spam > 0)

                            <p class="text-danger bounceInDown">Spam Reports:{{ $spam }}</p>
        
                            @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 crd-body">
            <div class="d-flex flex-column h-100">
                <div class=" h-75">
                    <p class="card-text crd-text h-100  p-3 mb-auto" >{{ $idea->description }}</p>
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


                                <div class="dropdown ms-1 @if($hasSpammed) d-none @endif"x-data>
                                    <button 
                                    x-cloak
                                    x-data="{ isOpen: true }"
                                    x-show="isOpen"
                                    x-init="
                                        window.livewire.on('ideaWasSpamed',() => {
                                            isOpen = false
                                        })
                                    "
                                    class="btn bg-black text-white dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        მენიუ
                                    </button>
                                    <ul class="dropdown-menu spam-dropdown" aria-labelledby="dropdownMenuButton1" >
                                        @can('delete', $idea)
                                        <li class="dropdown-item"><button class=" btn"
                                            @click="$dispatch('custom-show-delete-modal')"
                                            >Delete</button>
                                        </li>
                                        @endcan
                                        @if($hasSpammed == false)
                                       
                                        <li class="dropdown-item"
                                            x-cloak
                                            x-data="{ isOpen: true }"
                                            x-show="isOpen"
                                            x-init="
                                                window.livewire.on('ideaWasSpamed',() => {
                                                    isOpen = false
                                                })
                                            "
                                        ><button class=" btn"
                                            @click="$dispatch('custom-show-spam-modal')"
                                            
                                            >დარეპორტება</button>
                                        </li>
                                        
                                        @endif
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

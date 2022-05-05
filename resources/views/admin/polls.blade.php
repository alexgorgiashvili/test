@extends('admin.layouts.app')
@section('content')


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                
                <table id="dataTableExample" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="d-table-names">Name-1</th>
                            <th class="d-table-names">Name-2</th>
                            <th>Votes</th>
                            <th>Winner</th>
                            <th>Spams</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Expire Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ideas as $idea)
                        
                        {{-- Idea Type/1 --}}
                        
                        @if($idea->idea_type == 1)
                        <tr>
                            <th>{{ $idea->id }}</th>
                            <td>
                                <div class="d-flex">
                                    <div> <img src="{{ url('storage/images',$idea->image ) }}" alt="" > </div>
                                    <div class="d-table ms-2">
                                        <p class="d-table-cell align-middle">{{ $idea->title }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div> <img src="{{ asset('img/not-available.jpg') }}" alt="" > </div>
                                    <div class="d-table ms-2">
                                        <p class="d-table-cell align-middle">Name-2</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $idea->votes }}</td>
                            <td>
                                
                                @if( $idea->votes()->where('type',1)->count() > $idea->votes()->where('type',2)->count())
                                კი, პიტალოა
                                @else
                                არა, არაა პიტალო
                                @endif
                            </td>
                            <td>{{ $idea->spams }}</td>
                            <td>
                                <button class="btn bg-success rounded-pill text-white w-100 @if($idea->status != 'Open') bg-red @endif ">
                                    @if($idea->status== 'Open')
                                    აქტიური
                                    @else
                                    დასრულებული
                                    @endif
                                </button>
                            </td>
                            <td>{{ $idea->created_at->diffForHumans() }}</td>
                            <td>
                                @if ($idea->created_at_difference() <= 30)
                                <span class="text-success fw-6">დარჩა {{ $idea->created_at_difference() }} დღე</span>
                                @else
                                <span class="text-red fw-6">დასრულდა {{ $idea->created_at_difference() - 30 }} დღის წინ</span>
                                @endif
                                
                                
                            </td>
                            <td><a href="{{ route('admin_view',$idea) }}"class="btn btn-primary">Edit</a></td>
                        </tr>
                        
                        
                        {{-- Idea Type/2 --}}
                        
                        @else
                        <tr>
                            <th>{{ $idea->id }}</th>
                            <td>
                                <div class="d-flex">
                                    <div> <img src="{{ url('storage/images',$idea->image ) }}" alt="" > </div>
                                    <div class="d-table ms-2">
                                        <p class="d-table-cell align-middle">{{ $idea->title }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div> <img src="{{ url('storage/images',$idea->image_second ) }}" alt="" > </div>
                                    <div class="d-table ms-2">
                                        <p class="d-table-cell align-middle">{{ $idea->title_second }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $idea->votes}}</td>
                            <td>
                                @if( $idea->votes()->where('type',1)->count() > $idea->votes()->where('type',2)->count())
                                {{ $idea->title }} პიტალოა
                                @else
                                {{ $idea->title_second }} პიტალოა
                                @endif
                            </td>
                            <td>{{ $idea->spams}}</td>
                            <td><button class="btn bg-success rounded-pill text-white w-100 @if($idea->status != 'Open') bg-red @endif ">
                                @if($idea->status == 'Open')
                                აქტიური
                                @else
                                დასრულებული
                                @endif
                            </button>
                        </td>
                        <td>{{ $idea->created_at->diffForHumans() }}</td>
                        
                        
                        <td>
                            @if ($idea->created_at_difference() <= 30)
                            <span class="text-success fw-6">დარჩა {{ $idea->created_at_difference() }} დღე</span>
                            @else
                            <span class="text-red fw-6">დასრულდა {{ $idea->created_at_difference() - 30 }} დღის წინ</span>
                            @endif
                        </td>
                        <td><a href="{{ route('admin_view',$idea) }}"class="btn btn-primary">Edit</a></td>
                    </tr>
                    
                    @endif
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection

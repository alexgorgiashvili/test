@extends('admin.layouts.app')
@section('content')

<div class="col d-flex justify-content-md-end mb-4 ">
  <div class="btn-group mb-3 mb-md-0 me-md-4" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary mChartBtn">Month</button>
    <button type="button" class="btn btn-outline-primary yChartBtn">Year</button>
  </div>
</div>

{{-- Charts --}}

<div class="row position-relative">
  <div class="col-12 col-xl-12 stretch-card monthChart">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1 ">
              <h6 class="card-title mb-0 text-center">ახალი გამოკითხვები</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12 flex-column">
                <h3 class="mb-2 text-center">{{ $currentPolls }}</h3>
               
              </div>
              <div class="col-6 col-md-12 col-xl-12">
                <div id="customersChart" class="mt-md-3 mt-xl-0">{!! $chart->container() !!}</div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1">
              <h6 class="card-title mb-0 text-center">მიცემული ხმების ჯამი</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12">
                <h3 class="mb-2 text-center">{{ $currentVotes }}</h3>
                
              </div>
              <div class="col-6 col-md-12 col-xl-12">
                <div id="ordersChart" class="mt-md-3 mt-xl-0">{!! $votes->container() !!}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1 ">
              <h6 class="card-title mb-0 text-center">ახალი მომხმარებლები</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12 flex-column">
                <h3 class="mb-2 text-center">{{ $currentUsers }}</h3>
               
              </div>
              <div class="col-6 col-md-12 col-xl-12">
                <div id="customersChart" class="mt-md-3 mt-xl-0">{!! $users->container() !!}</div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  </div>
  <div class="col-12 col-xl-12 stretch-card yearChart position-absolute ">
    <div class="row flex-grow-1 mChartRow ">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1 ">
              <h6 class="card-title mb-0 text-center">ახალი გამოკითხვები</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12 flex-column">
                <h3 class="mb-2 text-center">{{ $currentPollsYear }}</h3>
               
              </div>
              <div class="col-6 col-md-12 col-xl-12">
                <div id="customersChart" class="mt-md-3 mt-xl-0">{!! $chartYear->container() !!}</div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1">
              <h6 class="card-title mb-0 text-center">მიცემული ხმების ჯამი</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12">
                <h3 class="mb-2 text-center">{{ $currentVotesYear }}</h3>
                
              </div>
              <div class="col-6 col-md-12 col-xl-12">
                <div id="ordersChart" class="mt-md-3 mt-xl-0">{!! $votesYear->container() !!}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1 ">
              <h6 class="card-title mb-0 text-center">ახალი მომხმარებლები</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12 flex-column">
                <h3 class="mb-2 text-center">{{ $currentUsersYear }}</h3>
               
              </div>
              <div class="col-6 col-md-12 col-xl-12">
                <div id="customersChart" class="mt-md-3 mt-xl-0">{!! $usersYear->container() !!}</div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  </div>

</div>
@push('javascripts')
<script src="{{ $chart->cdn() }}"></script>
 {{ $chart->script() }} 
 {{ $votes->script() }} 
 {{ $users->script() }} 
 {{ $chartYear->script() }} 
 {{ $votesYear->script() }} 
 {{ $usersYear->script() }} 


@endpush



@endsection
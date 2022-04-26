@extends('admin.layouts.app')
@section('content')

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center pb-1 ">
              <h6 class="card-title mb-0 text-center">New Customers</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-12 flex-column">
                <h3 class="mb-2 text-center">{{ $currentMonth }}</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
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
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">New Orders</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-3">
                <h3 class="mb-2">35,084</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-danger">
                    <span>-2.8%</span>
                    <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-9">
                <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Growth</h6>
              
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-3">
                <h3 class="mb-2">89.87%</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+2.8%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-9">
                <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
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


@endpush



@endsection
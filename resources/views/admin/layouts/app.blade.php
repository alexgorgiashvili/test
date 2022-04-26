<!DOCTYPE html>
<html lang="en">
<head>
	<meta  charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>Pitalo.ge</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- Data table css-->
	<link rel="stylesheet" href="{{ asset('/adminpanel/vendors/core/core.css') }}">
  <link rel="stylesheet" href="{{ asset('adminpanel/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('/adminpanel/css/style.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('/adminpanel/images/favicon.png') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
</head>
<body class=" sidebar-dark">
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
      <div class="sidebar-header">
        <a href="/" class="sidebar-brand">
          Pitalo<span>Ge</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>                                           
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>

          <li class="nav-item">
            <a href="{{ route('admin_dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">მთავარი</span>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{ route('admin_polls') }}" class="nav-link">
              <i class="link-icon" data-feather="layout"></i>
              <span class="link-title">გამოკითხვები</span>
            </a>
            
          </li>
   
          
        </ul>
      </div>
    </nav>
    
		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar">

				<div class="navbar-content">
          <div class="container-fluid">
            <div class="container-fluid position-relative">
              <a href="{{ route('admin_dashboard') }}" class="refresh-btn"><i class="bi bi-arrow-clockwise"></i></a>
              <form action="{{ route('admin_search') }}" method="get" class="row mt-2 gx-2">
                  <div class="col-4">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control geo-input admin-search-inp" id="geo_inp" placeholder="Search anything...">  
                        <button id="search-button" type="submit" class="btn btn-primary">
                          <i class="bi bi-search"></i>
                        </button>
                        <p class="tst-p"></p>
                  </div>
                  </div>
                  <div class="col-4 ">
                    <select class="form-select me-1 cursor-pointer admin-select-inp" name="top" aria-label="Default select example">
                      <option selected value="0">Select By</option>
                      <option value="1">Spams</option>
                      <option value="2">Votes</option>
                      </select>
                  </div>
                  <div class="col-4 d-flex">
                    <div class="w-50 me-2">
                      <div class=" input-group date datepicker  p-0 ">
                          <input type="date" name="calendar" class=" form-control admin-search-calendar">
                      </div>
                  </div>
                  <div class="w-50 ">
                    <div class=" input-group date datepicker p-0">
                      <input type="date" name="calendarTwo" class=" form-control admin-search-calendar">
                    </div>
                  </div>
                  </div>
                  
              </form>
              
           
          </div>
        </div>
			</nav>
			<!-- partial -->

			<div class="page-content">
        <div class="row">
          @yield('content')
       </div>
      </div>
		
		</div>
	</div>

	<!-- core:js -->
  
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="{{ asset('/adminpanel/vendors/core/core.js') }}"></script>
  <script src="{{ asset('/adminpanel/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('/adminpanel/vendors/feat her-icons/feather.min.js') }}"></script>
	<script src="{{ asset('/adminpanel/js/template.js') }}"></script>
	<!-- endinject -->


 

  {{-- Data table js  --}}
  <script src="{{ asset('/adminpanel/vendors/datatables.net/jquery.dataTables.js') }}" ></script>
  <script src="{{ asset('/adminpanel/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('/adminpanel/js/data-table.js') }}"></script>

   <!-- Charting library -->
{{-- <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script> --}}

 <script src="{{ asset('/adminpanel/js/dashboard-dark.js') }}"></script>
 

  @stack('javascripts')


  <script type="module">
    import jqueryGeokbd from 'https://cdn.skypack.dev/jquery-geokbd';
    $(".geo-input").geokbd();
    
  </script>

  
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
  
<script  src="{{ asset('js/lightbox.js') }}"></script>
<script  src="{{ asset('js/app.js') }}" ></script>

	<!-- End custom js for this page -->

</body>
</html>    
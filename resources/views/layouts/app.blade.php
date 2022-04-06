<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="{{ asset('css/lightbox.css') }}"  rel="stylesheet" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body >
    <!-- Sign form -->
    
    <livewire:sign-in-up/>
    
    
    {{-- Navbar --}}
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/pitalo.png') }}" alt="pitaloimg" srcset="" class="img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto">
                        @guest
                        <li class="nav-item me-2 " x-data>
                            <button @click=$dispatch('custom-show-signform') type="button" class="btn sign-btn w-100 w-sm-100 w-md-auto "><i class="bi bi-person-circle person-bef "></i></button>
                        </li>
                        @else
                        <li class="nav-item dropdown d-flex">
                            <img class="avatar-img" src="{{ asset(Auth::user()->avatar )}}" alt="{{ Auth::user()->name }}">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>
                            
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <li class="nav-item ">
                            <a class="nav-link btn bg-black text-white" href="{{ route('idea.create') }}">{{ __('Add') }}</a>
                        </li>
                    </ul>
                
            
                </div>
            </div>
        
    </nav>
    {{--  Body --}}
    <div class="container-lg pt-2 pt-md-5">
        <div class="row">
            
            <div class="col-md-3 mb-2 my-mb-0">   
                {{-- Top Voted Table --}}   
                {{-- <livewire:top-voted /> --}}
                <div class="accordion pt-2 pt-md-0" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button
                            class="accordion-button w-100 no-focus text-light bg-gray fw-bold vote-btn"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="false"
                            aria-controls="collapseOne"
                            >
                            Top Voted
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse show hide-area" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <table class="table caption-top">
                                <tbody class="vote-body">
                                    @foreach ($ideas as $idea )
                                    <tr class="position-relative  border-0">
                                        <th class="px-0 ps-1 border-0"><img src="{{ url('storage/images',$idea->image ) }} " class="img-responsive" alt=""></th>
                                        <td class="vote-td border-0"><a href="{{ route('idea.show',$idea) }}" class="text-secondary text-decoration-none">{{ $idea->title}}</a></td>
                                        <td class="vote-num fw-bold text-danger px-0 border-0">{{ $idea->votes()->count() }}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9 ">
                
                <div class="">
                    {{ $slot }}
                </div>
            </div>
            
        </div>
    </div>  
</div>



<!-- JavaScript Bundle with Popper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="module">
    import jqueryGeokbd from 'https://cdn.skypack.dev/jquery-geokbd';
    $(".geo-input").geokbd();
    
</script>
<script  src="{{ asset('js/lightbox.js') }}"></script>
<script  src="{{ asset('js/app.js') }}" ></script>


@livewireScripts
</body>
</html>

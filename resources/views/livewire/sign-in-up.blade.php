<div
    class="container-fluid fade-main-form "
    x-cloak
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-signform.window="isOpen = true"
    x-transition.origin.top.duration.300ms
    x-init="
        window.livewire.on('notLoggedIn',() => {
            isOpen = true
        })
    "
    x-init="
        window.livewire.on('logIn',() => {
            isOpen = false
        })
    "
>
    <div class="sign-up-main">
        <i @click=" isOpen = false " class="bi bi-x-lg sign-x-icon"></i>
        <div class="sign-up-inn">
            <div class="sign-up-div">
                <div @click="$dispatch('custom-show-signin')" class="change-form-btn"> Sign In</div>
                <div @click="$dispatch('custom-show-signup')" class="change-form-btn">Sign Up</div>
            </div>  
            <div class="fb-gg-icons ">
                <a class="text-decoration-none" href="{{ route('login.facebook') }}"><i class="bi bi-facebook fs-5  fb-inn-icons fb-clrr"></i></a>
                <a class="text-decoration-none" href="{{ route('login.google') }}"><i class="bi bi-google ms-1 fb-inn-icons gg-clrr"></i></a>
                
                
            </div>
            <h5 class="">or you can use your email:</h5>
            <div class="sign-form-main position-relative "
            x-data="{open1 : true}"
            @custom-show-signin.window="open1 = true"
            @custom-show-signup.window="open1 = false"
            :class=" open1 ? 'hh-text1' : 'hh-text2'" >
                <form wire:submit.prevent='signIn' method="POST" action="#"
                class=" pos-form-1 w-100" 
                x-cloak
                x-data="{ open1: true }"
                x-show="open1"
                @custom-show-signin.window="open1 = true"
                @custom-show-signup.window="open1 = false"
                
                 >
                    @csrf
                    <label  for="email"><i class="bi bi-envelope-fill form-inn-lab"></i></label>
                    <input wire:model.defer='email'  type="email" class="form-inn-inp " name="email"  required autocomplete="email" placeholder="Email" autofocus> 
                    
                    <label  for="pwd"><i class="bi bi-lock-fill form-inn-lab"></i></label>
                    <input wire:model.defer='password'  id="password" type="password" class="form-inn-inp " name="password" required autocomplete="current-password" placeholder="Password">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-secondary mt-2">login</button>
                </form>
                <form wire:submit.prevent='signUp' method="POST" action="#" 
                class="  pos-form-2"
                x-cloak
                x-data="{ open2: false }"
                x-show="open2"
                @custom-show-signup.window="open2 = true"
                @custom-show-signin.window="open2 = false"

                >
                @csrf
                    <label  for="name"><i class="bi bi-person-fill form-inn-lab"></i></label>
                    <input wire:model.defer='name'   id="name" type="text" class="form-inn-inp @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label  for="email"><i class="bi bi-envelope-fill form-inn-lab"></i></label>
                    <input wire:model.defer='email'   id="email" type="email" class="form-inn-inp @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label  for="pwd"><i class="bi bi-lock-fill form-inn-lab"></i></label>
                    <input wire:model.defer='password'    type="password" class="form-inn-inp @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}"> 
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label  for="password_confirmation"><i class="bi bi-lock-fill form-inn-lab form-labb-2"></i></label>
                    <input wire:model.defer='password_confirmation'   class="form-inn-inp rep-pass-inp " id="password_confirmation" type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}"> 
                    
                    <button type="submit" class="btn btn-danger my-3">Register</button>
                </form>
            
                
            </div>
            <p  class="faded-p"
                x-cloak
                x-data="{ signUp: true }"
                x-show="signUp"
                @custom-show-signin.window="signUp = true"
                @custom-show-signup.window="signUp = false"
                x-transition:enter.start="signup-transition"

            >Don't have an account?<span class="more-sign-click">Sign up</span></p>
        </div>       
    </div>
</div>

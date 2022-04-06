

<x-app-layout>
    <div class="dropdown">
        <a class="btn bg-black text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Choose Poll
        </a>
        
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <button class="dropdown-item " id="pollbtn-1">poll-1</button>
            <button class="dropdown-item " id="pollbtn-2">poll-2</button>
        </div>
    </div>
    @auth
    <div class="container-fluid position-relative px-0 pt-md-3 pt-1">
        <div class="col position-absolute w-100 " id="pollone">
            <form action="{{ route('store') }}" class="add-form " method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="title" class="form-label">Add Poll </label>
                    <input type="text"  name="title" class="form-control geo-input" id="geo_inp" ondragstart="return false;" ondrop="return false;" onpaste="return false" >
                    @error('title')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <p class="text-danger geo_key"></p>
                </div>
                <div class="form-floating mb-3">
                    <textarea data-gramm="false" type="text" name="description" class="form-control geo-input txt-area p-2" id="geo_inp2"  maxlength="100"></textarea>
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <p class="text-danger geo_key_area"></p>
                </div>
                
                <input name="image" class="form-control" type="file">
                <div class="form-check pt-3">
                    {{-- <input  wire:model.defer='hide_name' name='hide_name' type="hidden" value="1" > --}}
                    <input class="form-check-input no-focus cursor-pointer" wire:model.defer='hide_name' name='hide_name' type="checkbox" value="1"  >
                    <label class="form-check-label" >
                        Check For Hide Name
                    </label>
                </div>
                <input type="submit" class="btn btn-primary mt-2 d-block ms-auto dis-btn" value="Add">
            </form>
        </div>
        <div class="col position-absolute w-100  " id="polltwo">
            <form  class="add-form "action="{{ route('ideas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                
                <div class="mb-3">
                    <label  class="form-label">Add Poll </label>
                    <input  type="text" name="title" class="form-control geo-input" id="geo_inp3"  aria-describedby="emailHelp" >
                    @error('title')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input  type="text" name="titletwo" class="form-control geo-input" id="geo_inp4"  aria-describedby="emailHelp" >
                    @error('title')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="form-floating mb-3">
                    <textarea   data-gramm="false"
                    class="form-control txt-area p-2 geo-input" type="text"  id="geo_inp5"  name="description" maxlength="100"></textarea>
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    
                    @enderror
                    <p class="text-danger geo_key_area"></p>
                    
                </div>
                
                <input name="image" class="form-control" type="file">
                
                <input name="imagetwo" class="form-control mt-2" type="file">
                
                
                <div class="form-check pt-3">
                    <input class="form-check-input no-focus cursor-pointer"  name='hide_name' type="checkbox" value="1"  >
                    <label class="form-check-label" >
                        Check For Hide Name
                    </label>
                </div>
                
                <input type="submit" class="btn btn-primary mt-2 d-block ms-auto dis-btn" value="Add">
                
                
            </form>
        </div>

    </div>

    
    
    
    
    @endauth
    
    @guest
    <p>ჯერ გაიარეთ რეგისტრაცია.</p>
    @endguest
    {{-- <script type="module">
        import GeoKBD from 'https://cdn.skypack.dev/geokbd.js';
        let targetElement = document.querySelectorAll('[type="text"]');;
        let targetElement2 = document.getElementById("geo_inp2");
        let targetElement3 = document.getElementById("geo_inp3");
        let targetElement4 = document.getElementById("geo_inp4");
        let targetElement5 = document.getElementById("geo_inp5");
        let targetElement6 = document.getElementById("geo_inp6");
        let targetElement7 = document.getElementById("geo_inp7");
    
    
        GeoKBD.initialize();
        GeoKBD.attach(targetElement);
        // GeoKBD.attach(targetElement2);
        // GeoKBD.attach(targetElement3);
        // GeoKBD.attach(targetElement4);
        // GeoKBD.attach(targetElement5);
        // GeoKBD.attach(targetElement6);
        // GeoKBD.attach(targetElement7);
    </script> --}}
    
    
    
</x-app-layout>

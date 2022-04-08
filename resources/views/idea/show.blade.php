

<x-app-layout>

    {{-- Cards --}}

    <livewire:idea-show :idea="$idea" :votesCount="$votesCount" :spamsCount="$spamsCount"  /> 

    @can('update', $idea)
        {{-- <livewire:edit-idea :idea="$idea" /> --}}

    @endcan
    @can('delete', $idea)
            <livewire:delete-idea :idea="$idea" />

    @endcan
   
        <livewire:mark-idea-as-spam :idea="$idea" :spamsCount="$spamsCount" />

        <livewire:mark-idea-as-not-spam :idea="$idea"  />
 
            

    

    {{-- Comments --}}
<br>
    <div class="w-100">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="t2mYdRRX"> </script>
    <div class="fb-comments" data-colorscheme="dark" data-href="https://pitalo.ge/show/{{ $idea->title }}" data-numposts="10"
        data-width="100%" data-height="500px">
    </div>
</div>


</x-app-layout>

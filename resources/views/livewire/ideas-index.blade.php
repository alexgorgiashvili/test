<div class="row gy-2 pt-lg-0 pt-3">

    <div class="filters d-flex  w-100 ">

        <div>
            <select wire:model='filter'  name="other_filters" class="form-select no-focus " aria-label="Default select example">

                <option value="no Filter" selected></option>
                <option value="Top Voted">პოპულარული გამოკითხვები</option>
                <option value="My Surveys">ჩემი გამოკითხვები</option>
                @admin
                <option value="Spam Surveys">დარეპორტებული გამოკითხვები</option>
                @endadmin

              </select>
        </div>
        <div class="input-group mb-3 col ms-5 " style="width: 100px">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
            <input wire:model="search" type="search" name="search" class="form-control no-focus w-50"   aria-describedby="basic-addon1">
        </div>
    </div>

    {{-- Cards --}}

    @forelse ($ideas as $idea )


    <livewire:idea-index
        :idea="$idea"
        :votesCount="$idea->votes_count"
        :votesCount1="$idea->votes_count"
        :votesCount2="$idea->votes_count"
        :key="$idea->id"
        />
    @empty

    <p class="fw-bold text-red">გამოკითხვები ვერ მოიძებნა...</p>


    @endforelse

    <div>{{ $ideas->links() }}</div>


</div>

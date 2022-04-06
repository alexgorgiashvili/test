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


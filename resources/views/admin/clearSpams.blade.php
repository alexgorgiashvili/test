

<div class="modal-fixed-spams modal-pos-css" >
    <div class="modal-dialog">
      <div class="modal-content del-modal ">
        <div class="modal-header">
          <h5 class="modal-title">Clear Spams</h5>
        </div>
        <div class="modal-body">
          <p>Are You Sure you want to Clear Spams?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-secondary dlt-btn-close" >Close</button>
          <form action="{{ route('admin_clear_spams',$idea->id) }}">
            <button type="submit" class="btn bg-red admin-clear-spams">Clear</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>

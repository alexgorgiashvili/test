

<div class="modal-fixed-delete modal-pos-css" >
    <div class="modal-dialog">
      <div class="modal-content del-modal ">
        <div class="modal-header">
          <h5 class="modal-title">Delete Poll</h5>
        </div>
        <div class="modal-body">
          <p>Are You Sure you want do delete this Poll?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-secondary dlt-btn-close" >Close</button>
          <form action="{{ route('admin_delete',$idea->id) }}">
            <button type="submit" class="btn bg-red dlt-btn-dlt">Delete</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>

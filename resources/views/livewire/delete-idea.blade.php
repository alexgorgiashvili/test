<div x-data

class="modal-fixed" >
    <div
    x-cloak
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-delete-modal.window="isOpen = true"
    x-transition.origin.bottom.duration.300ms
    class="modal-dialog">
      <div class="modal-content del-modal ">
        <div class="modal-header">
          <h5 class="modal-title">Delete Survey</h5>
        </div>
        <div class="modal-body">
          <p>Are You Sure you want do delete this Survey?</p>
        </div>
        <div class="modal-footer">
          <button @click="isOpen = false" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button wire:click='deleteIdea' type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
  

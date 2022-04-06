<div x-data

class="modal-fixed" >
    <div
    x-cloak
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-spam-modal.window="isOpen = true"
    x-transition.origin.bottom.duration.300ms
    x-init="
        window.livewire.on('ideaWasSpamed',() => {
            isOpen = false
        })
    "
    class="modal-dialog">
      <div class="modal-content del-modal ">
        <div class="modal-header">
          <h5 class="modal-title">Spam Survey</h5>
        </div>
        <div class="modal-body">
          <p>Are You Sure you want do Report Spam?</p>
        </div>
        <div class="modal-footer">
          <button @click="isOpen = false" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button wire:click='markAsSpam' type="button" class="btn btn-danger">Spam</button>
        </div>
      </div>
    </div>
  </div>
  

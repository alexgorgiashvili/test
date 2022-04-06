<div x-data

class="modal-fixed" >
    <div
    x-cloak
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-clear-spam-modal.window="isOpen = true"
    x-transition.origin.bottom.duration.300ms
    x-init="
        window.livewire.on('ideaSpamCleared',() => {
            isOpen = false
        })
    "
    class="modal-dialog">
      <div class="modal-content del-modal ">
        <div class="modal-header">
          <h5 class="modal-title">Clear Survey Spam</h5>
        </div>
        <div class="modal-body">
          <p>Are You Sure you want do Clear Spam?</p>
        </div>
        <div class="modal-footer">
          <button @click="isOpen = false" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button wire:click='markAsNotSpam' type="button" class="btn btn-danger">Clear Spam</button>
        </div>
      </div>
    </div>
  </div>
  

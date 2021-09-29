<div>
    <form wire:submit.prevent="save">


    <input type="text" class="form-control" placeholder="ip" wire:model="text" value="{{$get_all}}">
        <button type="submit" class="btn btn-primary">Save</button>

    </form>
</div>

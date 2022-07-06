<!-- Modal create -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.cities.store') }}" method="post" autocomplete="off" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>  Add New City </label>
                        <input type="text" name="name" class="form-control" required="required" placeholder="Add New City" />
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="state">state</label>
                        <select name="state_id" class="form-control select2">
                            <option value="" selected disabled readonly>--select State--</option>
                            @forelse ( $states as $state)
                                <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : null }}>{{ $state->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

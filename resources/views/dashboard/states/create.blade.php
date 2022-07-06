<!-- Modal create -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.states.store') }}" method="post" autocomplete="off" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>  Add New State </label>
                        <input type="text" name="name" class="form-control" required="required" placeholder="Add New State" />
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
                        <label for="country">country</label>
                        <select name="country_id" class="form-control select2">
                            <option value="" selected disabled readonly>--select Country--</option>
                            @forelse ( $countries as $country)
                                <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
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

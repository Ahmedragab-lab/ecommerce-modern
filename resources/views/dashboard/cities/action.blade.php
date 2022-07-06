<div class="bn-group">
    <button type="button" class="btn btn-success btn-sm fonticon-wrap width-50" data-toggle="modal" title="edit"
            data-target="#edit{{ $city->id }}">
            <i class="icon-note"></i>
    </button>
    <button type="button" class="btn btn-danger btn-sm width-50" data-toggle="modal" data-target="#delete{{ $city->id }}" title="delete">
        <i class="icon-trash"></i>
    </button>
    <!-- Modal edit-->
    <div class="modal fade" id="edit{{ $city->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.cities.update',$city->id) }}" method="post" autocomplete="off" >
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>   Edit City </label>
                            <input type="text" name="name" class="form-control" required="required" value="{{ old('name',$city->name) }}" />
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status',$city->status) == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status',$city->status) == '0' ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="state">State</label>
                            <select name="state_id" class="form-control select2">
                                <option value="" selected disabled readonly>--select state--</option>
                                @forelse ( $states as $state)
                                    <option value="{{ $state->id }}" {{ old('state',$city->state->id) == $state->id ? 'selected' : null }}>{{ $state->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated rubberBand text-left"  tabindex="-1" role="dialog" aria-hidden="true" id="delete{{ $city->id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.cities.destroy',$city->id )}}" class="my-1 my-xl-0" method="post" style="display: inline-block;" >
                                @csrf
                                @method('delete')
                                <div class="modal-header" id="modal">
                                    <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.delete') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>{{ __('Admin/site.warning') }}</h5>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                                    <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.delete') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal bulk delete --}}
<form action="{{ route('admin.cities.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
    @csrf
    @method('delete')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated flipInY text-left" id="bulkdeleteall" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.bulkdelete') }}</h4>
                            <input type="hidden" id="delete_all" name="delete_select_id" value="">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin/site.warning') }}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
  {{--End modal bulk delete --}}

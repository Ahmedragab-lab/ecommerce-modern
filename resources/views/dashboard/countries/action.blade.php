<div class="bn-group">
    <button type="button" class="btn btn-success btn-sm fonticon-wrap width-50" data-toggle="modal" title="edit"
            data-target="#edit{{ $country->id }}">
            <i class="icon-note"></i>
    </button>
    <button type="button" class="btn btn-danger btn-sm width-50" data-toggle="modal" data-target="#delete{{ $country->id }}" title="delete">
        <i class="icon-trash"></i>
    </button>
    <!-- Modal edit-->
    <div class="modal fade" id="edit{{ $country->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.countries.update',$country->id) }}" method="post" autocomplete="off" >
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>   Edit Country </label>
                            <input type="text" name="name" class="form-control" required="required" value="{{ old('name',$country->name) }}" />
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status',$country->status) == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status',$country->status) == '0' ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated rubberBand text-left"  tabindex="-1" role="dialog" aria-hidden="true" id="delete{{ $country->id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.countries.destroy',$country->id )}}" class="my-1 my-xl-0" method="post" style="display: inline-block;" >
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
<form action="{{ route('admin.countries.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
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

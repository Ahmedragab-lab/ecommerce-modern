<div class="bn-group">
    <a class="btn btn-success btn-sm fonticon-wrap width-50" href="{{ route('admin.product_categories.edit',$cat->id )}}" title="edit">
        <i class="icon-note"></i>
    </a>
    {{-- <a class="btn btn-danger btn-sm" href="javascript:void(0)" title="delete"
        onclick="if(confirm('Are You Sure To Delete This Record'))
        {document.getElementById('delete-cat{{ $cat->id }}').submit();} else{'return false;'}">
        <i class="icon-trash"></i>
    </a>
    <form action="{{ route('admin.product_categories.destroy',$cat->id )}}"
        method="post" id="delete-cat{{ $cat->id }}" class="d-none">
        @csrf
        @method('DELETE')
    </form> --}}
    <button type="button" class="btn btn-danger btn-sm width-50" data-toggle="modal" data-target="#delete{{ $cat->id }}" title="delete">
        <i class="icon-trash"></i>
    </button>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated rubberBand text-left"  tabindex="-1" role="dialog" aria-hidden="true" id="delete{{ $cat->id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.product_categories.destroy',$cat->id )}}" class="my-1 my-xl-0" method="post" style="display: inline-block;" >
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
<form action="{{ route('admin.product_categories.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
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

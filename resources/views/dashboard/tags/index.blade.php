@extends('dashboard.layout.master')
@section('title', 'tags')
@section('css')

@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Tags</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tags
                                    <span style="color: red;font-weight:bolder;"> {{\App\Models\Tag::count() }} </span>
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <a href="{{ route('admin.tags.index') }}" class="btn btn-info mb-3 " style="margin-left: 50px;float: left;">
                                    <i class="icon-action-undo"></i> Back to tags
                                </a>
                                <a href="{{ route('admin.tags.create') }}" class="btn btn-primary mb-3 " style="margin-right: 10px">
                                    <i class="icon-plus"></i> Add New Tag
                                </a>
                                <button type="button" class="btn btn-warning mb-3" style="margin-right: 10px"
                                    id="btn_delete_all" data-toggle="modal"
                                    data-target="#bulkdelete" >
                                    <i class="icon-trash"></i>
                                    Bulk Delete
                                </button>

                                <div class="card-body card-dashboard">
                                    @include('dashboard.tags.filter')
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="select_all" id="select-all"> </th>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>product count</th>
                                                    <th>status</th>
                                                    <th>created at</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tags as $index=>$tag)
                                                    <tr>
                                                       <th >
                                                        <div class="animated-checkbox">
                                                            <label class="m-0">
                                                                <input type="checkbox" value="{{ $tag->id }}" name="delete_select" id="delete_select">
                                                                <span class="label-text"></span>
                                                            </label>
                                                        </div>
                                                       </th>
                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>{{ $tag->name }}</td>
                                                        <td>{{ $tag->products->count() }}</td>
                                                        <td>{{ $tag->status()}}</td>
                                                        <td>{{ $tag->created_at() }}</td>
                                                        <td>
                                                            @include('dashboard.tags.action')
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">no tags found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6">
                                                    <div class="float-right">
                                                        {!! $tags->appends(request()->all())->links() !!}
                                                    </div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection

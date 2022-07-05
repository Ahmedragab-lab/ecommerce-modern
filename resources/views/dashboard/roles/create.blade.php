@extends('dashboard.layout.master')
@section('title', 'roles')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">create new role</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a>
                                </li>
                                <li class="breadcrumb-item active">Add new role
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.roles.store') }}" method="post" >
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Role Name <span class="text-danger">*</span> </label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="Role Name"
                                                                   name="name"
                                                                   value="{{ old('name') }}" >
                                                            @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Permissions<span class="text-danger">*</span> </label>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Model</th>
                                                                        <th>select all</th>
                                                                        @foreach($permissionMaps as $key => $value)
                                                                          <th>Permission {{ $key+1 }}</th>
                                                                        @endforeach

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                {{-- @php
                                                                    $models = ['roles', 'users'];
                                                                @endphp --}}
                                                                @foreach ($models as $model)
                                                                    <tr>
                                                                        <td>{{ $model }} </td>
                                                                        <td>
                                                                            <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                                <label class="m-0">
                                                                                    <input type="checkbox" value="" name="" class="all-roles">
                                                                                    <span class="label-text">All</span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        @foreach ($permissionMaps as $permissionMap)
                                                                            <td>
                                                                                <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                                    <label class="m-0">
                                                                                        <input type="checkbox" value="{{ $permissionMap . '_' . $model }}" name="permissions[]" class="role">
                                                                                        <span class="label-text">{{ $permissionMap . ' ' . $model }}</span>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table><!-- end of table -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save Role
                                                </button>
                                            </div>
                                        </form>
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

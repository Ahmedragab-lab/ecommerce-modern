@extends('dashboard.layout.master')
@section('title', 'admins')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">edit admin <span style="color: red;">{{ $admin->full_name }}</span></h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">admins</a>
                                </li>
                                <li class="breadcrumb-item active">Edit admin
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
                                        <form class="form" action="{{ route('admin.admins.update',$admin->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">firstName</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="firstName"
                                                                   name="firstname"
                                                                   value="{{ old('firstname',$admin->firstname) }}" >
                                                            @error('firstname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">lastName</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="lastName"
                                                                   name="lastname"
                                                                   value="{{ old('lastname',$admin->lastname) }}" >
                                                            @error('lastname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email"
                                                                   class="form-control"
                                                                   placeholder="email"
                                                                   name="email"
                                                                   value="{{ old('email',$admin->email) }}" >
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input type="password"
                                                                   class="form-control"
                                                                   placeholder="password"
                                                                   name="password"
                                                                   value="{{ old('password') }}" >
                                                            @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Mobile No</label>
                                                            <input type="tel"
                                                                   class="form-control"
                                                                   placeholder="phone"
                                                                   name="phone"
                                                                   maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                                   value="{{ old('phone',$admin->phone) }}" />
                                                            @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1" {{ old('status',$admin->status) == 1 ? 'selected' : null }}>Active</option>
                                                            <option value="0" {{ old('status',$admin->status) == 0 ? 'selected' : null }}>Inactive</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-6" >
                                                        <div class="form-group">
                                                            <label for="tags">Roles</label>
                                                                <select name="role_id" class="select2 form-control"  id="id_h5_multi">
                                                                    <option value="" selected disabled readonly>---Selet role---</option>
                                                                    @forelse($roles as $role)
                                                                        <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                                                            {{ $role->name }}
                                                                        </option>
                                                                    @empty
                                                                    @endforelse
                                                            </select>
                                                            @error('roles')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Cover </label>
                                                            <input class="form-control img" name="image"  type="file" accept="image/*" >
                                                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                                                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        @if($admin->image)
                                                          <img src="{{ asset('images/admins/'.$admin->image) }}" alt="{{ $admin->full_name }}" class="img-thumbnail img-preview" width="200px">
                                                        @else
                                                          <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="100px">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Update
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

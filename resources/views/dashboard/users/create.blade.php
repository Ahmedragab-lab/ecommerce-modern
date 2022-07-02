@extends('dashboard.layout.master')
@section('title', 'users')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">انشاء سم جديد</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usesr</a>
                                </li>
                                <li class="breadcrumb-item active">Add new user
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
                                        <form class="form" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">firstName</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="firstName"
                                                                   name="firstname"
                                                                   value="{{ old('firstname') }}" >
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
                                                                   value="{{ old('lastname') }}" >
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
                                                                   value="{{ old('email') }}" >
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
                                                                   value="{{ old('phone') }}" >
                                                            @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                                                            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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
                                                        <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
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

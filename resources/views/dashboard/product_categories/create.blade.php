@extends('dashboard.layout.master')
@section('title', 'product_categories')
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.product_categories.index') }}">الاقسام</a>
                                </li>
                                <li class="breadcrumb-item active">انشاء قسم جديد
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
                                        <form class="form" action="{{ route('admin.product_categories.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Category Name</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="Category Name"
                                                                   name="name"
                                                                   value="{{ old('name') }}" >
                                                            @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="parent_id">Parent</label>
                                                            <select name="parent_id" class="form-control">
                                                                <option value="" selected disabled readonly>---Select Parent---</option>
                                                                @forelse($cats as $cat)
                                                                    <option value="{{ $cat->id }}"
                                                                        {{ old('parent_id')==$cat->id?'selected':null }} >
                                                                        {{ $cat->name }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            @error('parent_id')
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
                                                            <input class="form-control img" name="cover"  type="file" accept="image/*" >
                                                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                                                            @error('cover')<span class="text-danger">{{ $message }}</span>@enderror
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

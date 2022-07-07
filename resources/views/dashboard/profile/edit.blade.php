@extends('dashboard.layout.master')
@section('title', 'edit profile')
@section('css')

@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users edit start -->
            <section class="users-edit">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                        <i class="ft-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                        <i class="ft-info mr-25"></i><span class="d-none d-sm-block">Information</span>
                                    </a>
                                </li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <form class="form" action="{{ route('admin.profile.update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
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
                                                               value="{{ old('firstname',Auth::user()->firstname) }}" >
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
                                                               value="{{ old('lastname',Auth::user()->lastname) }}" >
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
                                                               value="{{ old('email',Auth::user()->email) }}" >
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
                                                               value="{{ old('phone',Auth::user()->phone) }}" />
                                                        @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{ old('status',Auth::user()->status) == 1 ? 'selected' : null }}>Active</option>
                                                        <option value="0" {{ old('status',Auth::user()->status) == 0 ? 'selected' : null }}>Inactive</option>
                                                    </select>
                                                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                                {{-- <div class="col-md-6" >
                                                    <div class="form-group">
                                                        <label for="tags">Roles</label>
                                                            <select name="role_id" class="select2 form-control"  id="id_h5_multi">
                                                                <option value="" selected disabled readonly>---Selet role---</option>
                                                                @forelse($roles as $role)
                                                                    <option value="{{ $role->id }}" {{ Auth::user()->hasRole($role->name) ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                        </select>
                                                        @error('roles')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div> --}}
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
                                                    @if(Auth::user()->image)
                                                      <img src="{{ asset('images/admins/'.Auth::user()->image) }}" alt="{{ Auth::user()->full_name }}" class="img-thumbnail img-preview" width="200px">
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
                                    <!-- users edit account form ends -->
                                </div>
                                {{-- <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <form novalidate>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <h5 class="mb-1"><i class="ft-link mr-25"></i>Social Links</h5>
                                                <div class="form-group">
                                                    <label>Twitter</label>
                                                    <input class="form-control" type="text" value="https://www.twitter.com/">
                                                </div>
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <input class="form-control" type="text" value="https://www.facebook.com/">
                                                </div>
                                                <div class="form-group">
                                                    <label>Google+</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>LinkedIn</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Instagram</label>
                                                    <input class="form-control" type="text" value="https://www.instagram.com/">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                                <h5 class="mb-1"><i class="ft-user mr-25"></i>Personal Info</h5>
                                                <div class="form-group">
                                                    <div class="controls position-relative">
                                                        <label>Birth date</label>
                                                        <input type="text" class="form-control birthdate-picker" required placeholder="Birth date" data-validation-required-message="This birthdate field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control" id="accountSelect">
                                                        <option>USA</option>
                                                        <option>India</option>
                                                        <option>Canada</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Languages</label>
                                                    <select class="form-control" id="users-language-select2" multiple="multiple">
                                                        <option value="English" selected>English</option>
                                                        <option value="Spanish">Spanish</option>
                                                        <option value="French">French</option>
                                                        <option value="Russian">Russian</option>
                                                        <option value="German">German</option>
                                                        <option value="Arabic" selected>Arabic</option>
                                                        <option value="Sanskrit">Sanskrit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" required placeholder="Phone number" value="(+656) 254 2568" data-validation-required-message="This phone number field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" placeholder="Address" data-validation-required-message="This Address field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control" placeholder="Website address">
                                                </div>
                                                <div class="form-group">
                                                    <label>Favourite Music</label>
                                                    <select class="form-control" id="users-music-select2" multiple="multiple">
                                                        <option value="Rock">Rock</option>
                                                        <option value="Jazz" selected>Jazz</option>
                                                        <option value="Disco">Disco</option>
                                                        <option value="Pop">Pop</option>
                                                        <option value="Techno">Techno</option>
                                                        <option value="Folk" selected>Folk</option>
                                                        <option value="Hip hop">Hip hop</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Favourite movies</label>
                                                    <select class="form-control" id="users-movies-select2" multiple="multiple">
                                                        <option value="The Dark Knight" selected>The Dark Knight
                                                        </option>
                                                        <option value="Harry Potter" selected>Harry Potter</option>
                                                        <option value="Airplane!">Airplane!</option>
                                                        <option value="Perl Harbour">Perl Harbour</option>
                                                        <option value="Spider Man">Spider Man</option>
                                                        <option value="Iron Man" selected>Iron Man</option>
                                                        <option value="Avatar">Avatar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- users edit Info form ends -->
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection

@extends('layouts.admin-dashboard')

@section('content')
    <section class="app-user-view-account">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                @include('pages.admin.profile.includes.user-card')
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                @include('pages.admin.profile.includes.head')
                <div class="card">
                    <h4 class="card-header">Profile Details</h4>
                    <div class="card-body">
                        <form id="formChangePassword" action="{{ route('admin.profile.update') }}"method="POST" role="form" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">First Name <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="text" name="first_name" class="form-control" required="" id="first_name" placeholder="First Name" value="{{old('first_name', Auth::guard('admin')->user()->first_name)}}">
                                    </div>
                                    @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Last Name <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{old('last_name', Auth::guard('admin')->user()->last_name)}}">
                                    </div>
                                    @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Phone Number <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="text" name="mobile" class="form-control numeric" id="mobile" placeholder="Phone Number" value="{{old('mobile', Auth::guard('admin')->user()->mobile)}}">
                                    </div>
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2 col-md-12 form-password-toggle d-flex">
                                    <a href="#" class="me-25">
                                        <img src="{{ ProfileHelper::getProfileImageFromFile(Auth::guard('admin')->user()->profile_image, AuthConstants::GUARD_ADMIN) }}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                    </a>
                                    <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                            <input type="file" id="account-upload" name="profile_image" hidden accept="image/png, image/jpeg, image/jpg" />
                                            <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                            <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                            @error('profile_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                        Discard
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
@endsection

@push('scripts')
    <script>
        const fp = $('#filter-by-date').flatpickr({
            maxDate: 'today',
            // mode: 'range',
            dateFormat: 'Y-m-d',
        });
        const fdj = $('#date-of-joining').flatpickr({
            dateFormat: 'Y-m-d',
        });
    </script>
    <script>

        $(function () {
            ('use strict');

            // variables
            var form = $('.validate-form'),
                accountUploadImg = $('#account-upload-img'),
                accountUploadBtn = $('#account-upload'),
                accountUserImage = $('.uploadedAvatar'),
                accountResetBtn = $('#account-reset');

            // Update user photo on click of button

            if (accountUserImage) {
                var resetImage = accountUserImage.attr('src');
                accountUploadBtn.on('change', function (e) {
                    var reader = new FileReader(),
                        files = e.target.files;
                    reader.onload = function () {
                        if (accountUploadImg) {
                            accountUploadImg.attr('src', reader.result);
                        }
                    };
                    reader.readAsDataURL(files[0]);
                });

                accountResetBtn.on('click', function () {
                    accountUserImage.attr('src', resetImage);
                    accountUploadBtn.val('');
                });
            }
        });
    </script>
@endpush

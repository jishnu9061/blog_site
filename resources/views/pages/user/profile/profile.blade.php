@extends('layouts.user-dashboard')

@section('content')
    <section class="app-user-view-account">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                @include('pages.user.profile.includes.user-card')
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                @include('pages.user.profile.includes.head')
                <div class="card">
                    <h4 class="card-header">Profile Details</h4>
                    <div class="card-body">
                        <form id="formChangePassword" action="{{ route('user.profile.update') }}"method="POST" role="form" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">First Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="text" name="first_name" class="form-control" required="" id="first_name" placeholder="First Name" value="{{old('first_name', Auth::guard('user')->user()->first_name)}}">
                                    </div>
                                    @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Last Name <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{old('last_name', Auth::guard('user')->user()->last_name)}}">
                                    </div>
                                    @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Email<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="email" name="email" class="form-control" required="" id="inputEmail" placeholder="Email" value="{{old('email', Auth::guard('user')->user()->email)}}">
                                    </div>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Phone Number<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="text" name="mobile" class="form-control numeric" id="mobile" placeholder="Phone Number" value="{{old('mobile', Auth::guard('user')->user()->mobile)}}">
                                    </div>
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2 col-md-6 form-password-toggle d-flex">
                                    <a href="#" class="me-25">
                                        <label class="form-label">Profile Picture </label>
                                        <img src="{{ ProfileHelper::getProfileImageFromFile(Auth::guard('user')->user()->profile_image, AuthConstants::GUARD_USER) }}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                    </a>
                                    <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                            <input type="file" id="account-upload" name="profile_image" hidden accept="image/png, image/jpeg, image/jpg" />
                                            <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                            <label class="form-label" for="newPassword">Allowed file types: png, jpg, jpeg.</label>
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

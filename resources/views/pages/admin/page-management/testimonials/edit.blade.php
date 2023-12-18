@extends('layouts.admin-dashboard')

@push('styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Testimonial</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{route('admin.testimonial.update',$testimonial->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('posted_by')is-invalid @enderror" id="posted_by" name="posted_by" value="{{ old('posted_by',  $testimonial->posted_by) }}"  placeholder="Posted By"
                                       @error('posted_by')aria-describedby="posted_by-error" aria-invalid="true" @enderror required>
                                @error('posted_by')
                                <span id="posted_by-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Message<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="message" class="form-control" rows="10" id="" required>{{ old('message',  $testimonial->message) }}</textarea>
                                @error('message')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Image<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <a href="#" class="me-25">
                                    <img src="{{ PageHelper::getTestimonialUserImage($testimonial->profile_image) }}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                </a>
                                <div class="d-flex align-items-end mt-75 ms-1">
                                    <a href="javascript:;">
                                        <div>
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Select</label>
                                            <input type="file" id="account-upload" name="profile_image" value="{{ old('profile_image') }}" hidden accept="image/png, image/jpeg, image/jpg" />
                                            <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                            <p class="form-label" class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                            @error('profile_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

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


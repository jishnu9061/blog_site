@extends('layouts.admin-dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add User</h4>
        </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name')is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}"  placeholder="Enter First Name"
                                   @error('first_name')aria-describedby="first_name-error" aria-invalid="true" @enderror required>
                            @error('first_name')
                            <span id="first_name-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">Last Name </label>
                            <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}"  placeholder="Enter Last Name"
                                   @error('last_name')aria-describedby="last_name-error" aria-invalid="true" @enderror>
                            @error('last_name')
                            <span id="last_name-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('mobile')is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}"  placeholder="Enter Mobile"
                                   @error('mobile')aria-describedby="mobile-error" aria-invalid="true" @enderror required>
                            @error('mobile')
                            <span id="mobile-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  placeholder="Enter Email"
                                   @error('email')aria-describedby="email-error" aria-invalid="true" @enderror required>
                            @error('email')
                            <span id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password" value="{{ old('password') }}"  placeholder="Enter Password"
                                   @error('password')aria-describedby="password-error" aria-invalid="true" @enderror required>
                            @error('password')
                            <span id="password-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password')is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"  placeholder="Re-enter Password"
                                   @error('password_confirmation')aria-describedby="password_confirmation-error" aria-invalid="true" @enderror required>
                            @error('password')
                            <span id="password_confirmation-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  col-12">
                        <div class="mb-1">
                            <label class="form-label">Country</label>
                            <select id="country" name="country" class="select2 form-select">
                                <option value="">Select Country</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var App = {
                initialize: function () {

                }
            };
            App.initialize();
        })
    </script>
@endsection

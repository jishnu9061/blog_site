@extends('layouts.admin-dashboard', ['title' => 'Create Category'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Categories</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ route('admin.category.store') }}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Name<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="name"
                                    name="name" value="" placeholder="Enter Name"
                                    @error('name')aria-describedby="name-error" aria-invalid="true" @enderror>
                                @error('name')
                                    <span id="title-error" class="error invalid-feedback"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Description<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="description"
                                    name="description" value="" placeholder="Enter description"
                                    @error('description')aria-describedby="description-error" aria-invalid="true" @enderror>
                                @error('description')
                                    <span id="title-error" class="error invalid-feedback"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var App = {
                initialize: function() {
                    $('.summer-note').summernote();
                }
            };
            App.initialize();
        })
    </script>
@endpush


74
resources/views/pages/admin/suite/amenities/edit.blade.php


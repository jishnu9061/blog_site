@extends('layouts.admin-dashboard',['title' => 'Create Page'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
@endpush

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Page</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{route('admin.page.store')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Title<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('title')is-invalid @enderror" id="title" name="title" value=""  placeholder="Title"
                                       @error('title')aria-describedby="title-error" aria-invalid="true" @enderror required>
                                @error('title')
                                <span id="title-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Description<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control summer-note  @error('description')is-invalid @enderror" id="description"   @error('description')aria-describedby="description-error" aria-invalid="true" @enderror required >
                                </textarea>
                                @error('description')
                                <span id="description-error" class="error invalid-feedback" style="display: block;"></span>
                                @enderror
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
    </div>
@endsection

@push('scripts')
<script src="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var App = {
                initialize: function () {
                    $('.summer-note').summernote();
                }
            };
            App.initialize();
        })
    </script>
@endpush

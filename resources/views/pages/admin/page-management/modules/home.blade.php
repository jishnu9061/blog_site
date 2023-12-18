@extends('layouts.admin-dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
    <div class="card">
        <form action="{{route('admin.page.update',$page->id)}}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4 class="card-title">Edit Page</h4>
            </div>
            <div class="card-body">
                   <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                 <label for="title">Title<span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title', $page->name) }}" placeholder="Enter Title" required>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label for="title">Description<span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control summer-note" id="" >{{ old('description', $page->description) }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <select class="hide-search form-select" id="status" name="status">
                                    <option value="" selected disabled>Select status</option>
                                    @foreach (PageConstant::STATUS as $key => $status)
                                        <option value="{{ $key }}" {{ (old('status', $page->status) == $key ) ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <span id="status-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
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

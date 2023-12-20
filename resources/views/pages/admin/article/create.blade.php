@extends('layouts.admin-dashboard', ['title' => 'Create Tag'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Article</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ route('admin.article.store') }}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="category">Category</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control select @error('category') is-invalid @enderror" id="category"
                                    name="category">
                                    <option value="" selected disabled>Select a category</option>
                                    @foreach ($categories as $id => $category_name)
                                        <option value="{{ $id }}">{{ $category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span id="category-error" class="error invalid-feedback"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="category">Tag</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control  @error('category') is-invalid @enderror" id="tags"
                                    name="tags[]" multiple>
                                    <option value="" disabled>Select a tag</option>
                                    @foreach ($tags as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <span id="category-error" class="error invalid-feedback"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="first-name">Title<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="title"
                                    name="title" value="" placeholder="Enter Title"
                                    @error('title')aria-describedby="title-error" aria-invalid="true" @enderror>
                                @error('title')
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
                                <input type="text" class="form-control @error('name')is-invalid @enderror"
                                    id="description" name="description" value="" placeholder="Enter description"
                                    @error('description')aria-describedby="description-error" aria-invalid="true" @enderror>
                                @error('description')
                                    <span id="title-error" class="error invalid-feedback"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="image">Image</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <span id="image-error" class="error invalid-feedback"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        jQuery.noConflict();
        $(document).ready(function() {
            $('#tags').select2();
        });
    </script>
@endpush

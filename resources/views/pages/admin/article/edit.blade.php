@extends('layouts.admin-dashboard', ['title' => 'Edit Article'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/summernote/summernote-bs4.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ route('admin.article.update',['article'=>$article->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Category -->
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="category">Category</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control select @error('category') is-invalid @enderror" id="category" name="category">
                                    <option value="" disabled>Select a category</option>
                                    @foreach ($categories as $id => $category_name)
                                        <option value="{{ $id }}" @if($article->category_id == $id) selected @endif>{{ $category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span id="category-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="tags">Tags</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags[]" multiple>
                                    <option value="" disabled>Select tags</option>
                                    @foreach ($tags as $id => $name)
                                        <option value="{{ $id }}" @if(in_array($id, $selectedTags)) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <span id="tags-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="title">Title<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                    name="title" value="{{ old('title',$article->title) }}" placeholder="Enter Title">
                                @error('title')
                                    <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="description">Description<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" value="{{ old('description',$article->description) }}" placeholder="Enter description">
                                @error('description')
                                    <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="image">Image</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <span id="image-error" class="error invalid-feedback">{{ $message }}</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tags').select2();
        });
    </script>
@endpush

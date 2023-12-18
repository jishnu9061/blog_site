@extends('layouts.admin-dashboard')
@push('styles')
    <style>
        .golden-star {
            color: gold;
        }
    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
            <div id="buttons" class="d-flex">
                <div id="buttons">
                    <a href="{{ route('admin.tag.create') }}"
                        class="btn btn-primary  waves-effect waves-light">Create</a>
                </div>

            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table id="data-table" class="card-datatable table">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tag</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($tags as $tag)
                            <tr class="text-center">
                                <td style="padding: 10.28px 0px">{{ $loop->iteration }}</td>
                                <td style="padding: 10.28px 0px">{{ $tag->name }}</td>
                                <td style="padding: 10.28px 0px">{{ $tag->description }}</td>
                                <td style="padding: 10.28px 0px" class="pe-1"> <a
                                        href="{{ route('admin.tag.edit', $tag->id) }}"
                                        class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></i></a>
                                    <a href="javascript:;" data-id="{{ $tag->id }}"
                                        data-href="{{ route('admin.category.destroy', $tag->id) }}"
                                         class="btn btn-danger btn-sm deleteItem"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="float-end me-5 mt-2">
                {!! $tags->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.deleteItem').click(function(e) {
                e.preventDefault();
                var row = $(this).closest('tr');
                var url = $(this).data('href');
                App.deleteItem(row, url);
            });

            var App = {
                deleteItem: function(row, url) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete the tag!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(data) {
                                        location.reload();
                                },
                                error: function(data) {
                                    console.log(data);
                                }
                            });
                        }
                    });
                }
            };
            app.initialize();
        });
    </script>
@endpush

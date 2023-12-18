@extends('layouts.admin-dashboard')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{PageHelper::getTotalTestimonialCount()}}</h3>
                        <span>Total Testimonials</span>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <span class="avatar-content">
                            <i data-feather="user" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">0</h3>
                        <span>--</span>
                    </div>
                    <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                            <i data-feather="user-plus" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">0</h3>
                        <span>--</span>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <span class="avatar-content">
                            <i data-feather="user-check" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">0</h3>
                        <span>--</span>
                    </div>
                    <div class="avatar bg-light-warning p-50">
                        <span class="avatar-content">
                            <i data-feather="user-x" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body border-bottom">
            <h4 class="card-title">Search & Filter</h4>
            <div class="row">
                <div class="col-md-4 user_role">
                </div>
                <div class="col-md-4 user_country">
                </div>
                <div class="col-md-4 user_testimonial">
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table id="data-table" class="card-datatable table">
                <thead class="table-light">
                    <tr>

                        <th>Name</th>
                        <th></th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        var app = {
            initialize: function () {

                var datatable = $('#dataTable1').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: false,
                    info: true,
                    autoWidth: true,
                });

                $('#dataTable1').on('click', '.delete', function(e) {
                    e.preventDefault();
                    var row = datatable.rows( $(this).parents('tr') );
                    var url = $(this).data('href');
                    app.deleteItem(row, url);
                });

                $('#resetForm').on('click', app.resetFilterForm);
            },
            deleteItem: function(row, url) {
                if (confirm('Are you sure you want to delete this testimonial?')) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success : function(data) {
                            row.remove().draw();
                            toastr.success(data.success);
                        }
                    });
                }
            },
        };
        app.initialize();

document.addEventListener('DOMContentLoaded', function() {
    var newUserSidebar = $('.new-user-modal'),
    newUserForm = $('.add-new-user'),
    select = $('.select2'),
    dtContact = $('.dt-contact'),
    statusObj = {
      0: { title: 'Inactive', class: 'badge-light-warning' },
      1: { title: 'Active', class: 'badge-light-success' },
      2: { title: 'Archived', class: 'badge-light-secondary' }
    };
    select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });
   var dataTable = $('#data-table').DataTable({
       ajax: {
           url: '{{ route("admin.testimonial.get-testimonials") }}',
           dataSrc: ''
       },
       columns: [ {
            row:'posted_by',
               render: function(data, type, row) {
                    var usersId = row.id;
                    var url = '{{ route("admin.testimonial.edit",":id")}}';
                    url = url.replace(':id', row.id);
                   var imageSource = '{{ asset('web_components/app-assets/images/avatars/1-small.png') }}' + row.profile_picture;
                   return '<div class="d-flex justify-content-left align-items-center">' +
                          '<div class="avatar-wrapper">' + '<div class="avatar me-1">' +
                            '<img src="{{ asset('web_components/app-assets/images/avatars/1-small.png') }} "+ row.profile_picture  alt="Avatar" height="32" width="32">'+
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                          '<a href="'+url+'" class="user_name text-truncate text-body"><span class="fw-bolder">'+
                            row.posted_by +
                          '</span></a>'+
                          '<small class="emp_post text-muted">'+
                        '</small>' +
                        '</div>' +
                        '</div>';
               }
            },

            // { data: '' },
            { data: 'posted_by' },
            { data: 'message' },
            { data: '' },
           // Define other columns
       ],
       columnDefs: [
        { 'visible': false, 'targets': [1]},
        {
          targets: -1,
          title: 'Actions',
          orderable: false,

    render: function (data, type, row, meta) {
        var url = '{{ route("admin.testimonial.edit",":id")}}';
        url = url.replace(':id', row.id);
      return (
        '<div class="btn-group">' +
        '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
        feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
        '</a>' +
        '<div class="dropdown-menu dropdown-menu-end">' +
        '<a href="'+url+'" class="dropdown-item">' +
        feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
        'Edit</a>' +
        '<a href="javascript:;" data-id="'+ row.id +'" class="dropdown-item delete-record">' +
        feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
        'Delete</a></div>' +
        '</div>' +
        '</div>'
      );
    }
  },
       ],
 order: [[1, 'desc']],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      },
 buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [0,2] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [0,2] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0,2] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [0,2] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [0,2] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
            }, 50);
          }
        },
        {
          text: 'Create',
          className: 'add-new btn btn-primary',
          attr: {
            'onclick':'visitPage();'
            // 'data-bs-toggle': 'modal',
            // 'data-bs-target': '#modals-slide-in'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],

   // For responsive popup
   responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
       language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      initComplete: function () {

        // Adding message filter once table initialized
        this.api()
          .columns(1)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="FilterTransaction">Name</label>').appendTo('.user_testimonial');
            var select = $(
              '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value="">--Select--</option></select>'
            )
              .appendTo('.user_testimonial')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

              column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
      }
   });

   // Fetch data using Axios
   axios.get('{{ route("admin.testimonial.get-testimonials") }}')
       .then(function(response) {
           // Update DataTable with fetched data
        //    console.log('Response:', response.data);
           dataTable.clear().rows.add(response.data).draw();
       })
       .catch(function(error) {
           console.error('Error fetching data:', error);
       });
       $(document).on('click', '.delete-record', function() {
         var recordId = $(this).data('id');
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert back!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete Testimonial!',
            customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
            },
             buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
            Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: 'Testimonial has been Deleted.',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
          deleteRecord(recordId);

        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Cancelled',
            text: 'Cancelled Deletion :)',
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
        }
      });

});

function deleteRecord(recordId) {
    console.log('delete id',recordId);
    var url = '{{ route("admin.testimonial.destroy", ":id") }}';
    url = url.replace(':id', recordId);
$.ajax({
    url: url,
    type: 'DELETE',
    success: function(result) {
        // Do something with the result
        dataTable.ajax.reload();
        // window.location.reload();
    },
    error: function(request,msg,error) {
        // handle failure
    }
});
}

});
function visitPage(){
    window.location='{{route('admin.testimonial.create')}}';
}

</script>

@endpush


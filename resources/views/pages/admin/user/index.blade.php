
@extends('layouts.admin-dashboard')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}"> --}}
@endpush

@section('content')
    <section class="app-user-list">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{UserHelper::getTotalUserCount()}}</h3>
                            <span>Total Users</span>
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
                            <h3 class="fw-bolder mb-75">{{UserHelper::getActiveUserCount()}}</h3>
                            <span>Active Users</span>
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
                    <div class="col-md-4 user_status">
                    </div>
                </div>
            </div>
                <div class="card-datatable table-responsive pt-0">
                    <table id="data-table" class="card-datatable table">
                        <thead class="table-light">
                            <tr>

                                <th>Name</th>
                                <th>Country</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
        <!-- list and filter end -->
    </section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var newUserSidebar = $('.new-user-modal'),
    newUserForm = $('.add-new-user'),
    select = $('.select2'),
    dtContact = $('.dt-contact'),
    statusObj = {
        0: { title: 'Active', class: 'badge-light-success' },
        1: { title: 'Inactive', class: 'badge-light-warning' },

    //   2: { title: 'Archived', class: 'badge-light-secondary' }
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
           url: '{{ route("get.data") }}',
           dataSrc: ''
       },
       columns: [
           {
            row:'first_name',
               render: function(data, type, row) {
                    var usersId = row.id;
                    var url = '{{ route("admin.view-data",":id")}}';
                    url = url.replace(':id', row.id);
                    var colorClass = $imageSource === '' ? ' bg-light-' + $state + ' ' : '';
                    var $imageSource = '{{ asset('web_components/app-assets/images/avatars/1-small.png') }}' + row.profile_picture;

                    if ($imageSource) {
                        var $output = '<img src="{{ asset('web_components/app-assets/images/avatars/1-small.png') }} "+ row.profile_picture  alt="Avatar" height="32" width="32">'
                    } else {
                        var stateNum = Math.floor(Math.random() * 6) + 1;
                        var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state = states[stateNum],
                            $name = row['first_name'],
                            $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + '</span>';
                    }

                    return '<div class="d-flex justify-content-left align-items-center">' +
                          '<div class="avatar-wrapper">' + '<div class="avatar '+ colorClass +' me-1">' +
                            // '<img src="{{ asset('web_components/app-assets/images/avatars/1-small.png') }} "+ row.profile_picture  alt="Avatar" height="32" width="32">'+
                                $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                          '<a href="'+url+'" class="user_name text-truncate text-body"><span class="fw-bolder">'+
                            row.first_name + ' ' + row.last_name+
                          '</span></a>'+
                          '<small class="emp_post text-muted">'+ row.email +
                        '</small>' +
                        '</div>' +
                        '</div>';
               }
            },

        //    { data: 'first_name' },
           { data: 'country' },
           { data: 'mobile' },
           { data: 'status' },
           { data: '' },
       ],
       columnDefs: [


        {
          // User Status
          targets: 3,
          render: function (data, type, full, meta) {
            var $status = full['status'];
            return (
              '<span class="badge rounded-pill ' +
              statusObj[$status].class +
              '" text-capitalized>' +
              statusObj[$status].title +
              '</span>'
            );
          }
        },
        {
          targets: -1,
          title: 'Actions',
          orderable: false,

    render: function (data, type, row, meta) {
        var url = '{{ route("admin.view-data",":id")}}';
        var deleteUrl = '{{ route("admin.user.destroy",":id")}}';
        url = url.replace(':id', row.id);
        deleteUrl = deleteUrl.replace(':id', row.id);


      return (
        '<div class="btn-group">' +
        '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
        feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
        '</a>' +
        '<div class="dropdown-menu dropdown-menu-end">' +
        '<a href="'+url+'" class="dropdown-item">' +
        feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
        'Details</a>' +
        '<a href="javascript:;" data-id="'+ row.id +'" data-href="'+deleteUrl+'" class="dropdown-item delete-record">' +
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
              exportOptions: { columns: [1, 2, 3] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3] }
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
              return col.columnIndex !== 4 // ? Do not show row in modal popup if title is blank (for check box)
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
        // Adding role filter once table initialized
        // this.api()
        //   .columns()
        //   .every(function () {
        //     var column = this;
        //     var label = $('<label class="form-label" for="UserRole">Role</label>').appendTo('.user_role');
        //     var select = $(
        //       '<select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
        //     )
        //       .appendTo('.user_role')
        //       .on('change', function () {
        //         var val = $.fn.dataTable.util.escapeRegex($(this).val());
        //         column.search(val ? '^' + val + '$' : '', true, false).draw();
        //       });

        //     column
        //       .data()
        //       .unique()
        //       .sort()
        //       .each(function (d, j) {
        //         select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
        //       });
        //   });
        // Adding country filter once table initialized
        this.api()
          .columns(1)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="UserPlan">Country</label>').appendTo('.user_country');
            var select = $(
              '<select id="UserPlan" class="form-select text-capitalize mb-md-0 mb-2"><option value="">--Select--</option></select>'
            )
              .appendTo('.user_country')
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
        // Adding status filter once table initialized
        this.api()
          .columns(3)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="FilterTransaction">Status</label>').appendTo('.user_status');
            var select = $(
              '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value="">--Select--</option></select>'
            )
              .appendTo('.user_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                    statusObj[d].title +
                    '" class="text-capitalize">' +
                    statusObj[d].title +
                    '</option>'
                );
              });
          });
      }
  });

   // Fetch data using Axios
   axios.get('{{ route("get.data") }}')
       .then(function(response) {
           // Update DataTable with fetched data
           dataTable.clear().rows.add(response.data).draw();
       })
       .catch(function(error) {
           console.error('Error fetching data:', error);
       });

       $(document).on('click', '.delete-record', function() {
         var recordId = $(this).data('id');
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete user!',
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
            text: 'User has been Deleted.',
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
axios.delete('user/'+recordId+'')
    .then(function(response) {
        // Handle success and refresh DataTable
        dataTable.ajax.reload();
        // window.location.reload();
    })
    .catch(function(error) {
        console.error('Error deleting record:', error);
    });
}

});
function visitPage(){
    window.location='{{route('admin.user.create')}}';
}
</script>
@endpush



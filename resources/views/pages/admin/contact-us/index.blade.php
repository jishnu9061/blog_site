@extends('layouts.admin-dashboard')

@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{ContactUsHelper::getTotalMessageCount()}}</h3>
                        <span>Total Messages</span>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <span class="avatar-content">
                            <i data-feather="mail" class="font-medium-4"></i>
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
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Created On</th>
                        <th>Message</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-upgrade-plan" role="document">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <h5 class="modal-title" id="exampleModalLabel">Message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p id="message-content"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary mt-2" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {

    select = $('.select2'),
    dtContact = $('.dt-contact'),
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
           url: '{{ route("admin.contact-us.get-message") }}',
           dataSrc: ''
       },
       columns: [
            { data: 'customer_name' },
            { data: 'email' },
            { data: 'subject' },
            { data: 'created_at',
               render: function(data, type, row) {
                    const jsonDate = data;
                    const datePart = jsonDate.split("T")[0];
                    return datePart;
               }},

            { data: 'messages',
            render: function(data, type, row) {

                    var jsonMessage = data;
                    var messagePart = jsonMessage.length;
                    if(messagePart<100){
                        return jsonMessage;
                    }else{

                        var url = '{{ route("admin.contact-us.message",":id")}}';
                        url = url.replace(':id', row.id);
                        var maxLength = 100;
                        var trimmedString = jsonMessage.substring(0, maxLength);
                        // console.log(jsonMessage);
                        return trimmedString +'<a class="show-read-more-modal" name= tabs href="#" data-bs-toggle="modal" data-bs-target="#myModal" data-message="' + jsonMessage + '" >Read More</a>';
                    }
               }
        },
       ],

       columnDefs: [
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
              exportOptions: { columns: [0,1,2,3,4] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1,2,3,4] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1,2,3,4] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1,2,3,4] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1,2,3,4] }
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

  // Adding country filter once table initialized
  this.api()
          .columns(0)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="UserPlan">Customer Name</label>').appendTo('.user_country');
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
            // Adding message filter once table initialized
            this.api()
          .columns(1)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="FilterTransaction">Email</label>').appendTo('.user_testimonial');
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
   axios.get('{{ route("admin.contact-us.get-message") }}')
       .then(function(response) {
           // Update DataTable with fetched data
        //    console.log('Response:', response.data);
           dataTable.clear().rows.add(response.data).draw();
       })
       .catch(function(error) {
           console.error('Error fetching data:', error);
       });
});
$(document).on('click', '.show-read-more-modal', function() {
  var message = $(this).data('message');
  $('#message-content').text(message);
});

</script>

@endpush

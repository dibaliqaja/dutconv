@extends('layouts.home')
@section('title_page','Customers DataTable')
@section('content')

    <div class="table-responsive">
        Filter:
        <select name="filter_date" id="filter-date">
            <option value="">-- All entries --</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
            <option value="365">Last 365 days</option>
        </select>
        <br/><br/>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr align="center">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <input type="text" class="form-control filter-input" placeholder="Search for name" data-column="0">
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input" placeholder="Search for email" data-column="1">
                    </td>
                </tr>
                {{-- <tr>
                    <td>
                        <select data-column="0" class="form-control filter-select">
                            <option value="">Select name</option>
                                @foreach ($names as $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                        </select>
                    </td>
                    <td>
                        <select data-column="1" class="form-control filter-select">
                            <option value="">Select email</option>
                                @foreach ($emails as $email)
                                    <option value="{{ $email }}">{{ $email }}</option>
                                @endforeach
                        </select>
                    </td>
                </tr> --}}
            </tfoot>
        </table>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready( function () {
            var table = $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('customers.datatable.index') }}",
                    "data": function (d) {
                        d.date_filter = $('#filter-date').val();
                    },
                },
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "created_at" },
                    { "data": "" },
                ],
                columnDefs: [{
                    targets: -1,
                    render: function(data, type, row) {
                        return '<a class="btn btn-sm btn-info" href="/{{ request()->segment(1) }}/' + row['id'] + '/edit">Edit</a> ' +
                        '<form action="/{{ request()->segment(1) }}/' + row['id'] + '/delete" method="POST" style="display:inline">' +
                            '<input type="hidden" name="_method" value="DELETE" />' +
                            '<input type="hidden" name="_token" value="{{ csrf_token() }}" />' + 
                            '<input type="submit" class="btn btn-sm btn-danger" value="Delete" />' +
                        '</form>';
                    }
                }],
            });

            $('#filter-date').change(function () {
                table.draw();
            });

            $('.filter-input').keyup(function () {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });

            $('.filter-select').change(function () {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
        });
    </script>
@endsection
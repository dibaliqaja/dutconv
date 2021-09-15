@extends('layouts.home')
@section('title_page','Customers DataTable')
@section('content')

    <div class="table-responsive">
        <table class="table table-striped" id="datatable">
            <thead>
                <tr align="center">
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('customers.datatable.index') }}",
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                ],
            });
        });
    </script>
@endsection
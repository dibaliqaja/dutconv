@extends('layouts.home')
@section('title_page','Customers Table')
@section('content')

    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('customers.table.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer => $result)
                    <tr>
                        <td>{{ $customer + $customers->firstitem() }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $customers->links() }}
        </div>
    </div>

@endsection
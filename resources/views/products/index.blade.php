@extends('layouts.home')
@section('title_page','Products')
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
                        <button onclick="window.location.href='{{ route('products.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
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
                    <th>Nama Product</th>
                    <th>Unit</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product => $result)
                    <tr>
                        <td>{{ $product + $products->firstitem() }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->product_units->name }}</td>
                        <td>{{ $result->qty }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

@endsection
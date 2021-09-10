@extends('layouts.home')
@section('title_page','Product Units')
@section('content')

    @if (Session::has('alert'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <a href="{{ route('product-units.create') }}" class="btn btn-primary">Tambah Unit</a><br><br>
        </div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('product-units.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
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
                    <th>Nama Product Unit</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($product_units as $product_unit => $result)
                    <tr>
                        <td>{{ $product_unit + $product_units->firstitem() }}</td>
                        <td>{{ $result->name }}</td>
                        <td align="center">
                            <a href="{{ route('product-units.edit', $result->id) }}" type="button" class="btn btn-sm btn-info"><i class="fas fa-pen"></i></a>                            
                            <a href="javascript:void(0)" id="btn-delete" class="btn btn-sm btn-danger" onclick="deleteData('{{ $result->id }}')" data-toggle="modal" data-target="#deleteProductUnitModal"><i class="fas fa-trash"></i></a>
                        </td> 
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $product_units->links() }}
        </div>
    </div>

@endsection

@section('modal')
    <!-- Modal Delete -->
    <div class="modal fade" id="deleteProductUnitModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="javascript:void(0)" id="deleteForm" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Hapus Product Units</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" onclick="formSubmit()" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteData(id) {
            let url = '{{ route("product-units.destroy", ":id") }}';
            url     = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
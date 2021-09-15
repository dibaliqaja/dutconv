@extends('layouts.home')
@section('title_page','Instansi')
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahInstansi">Tambah Instansi</button>
        </div>
        <div class="col-md-4 mb-3">
            <form action="#" class="flex-sm">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                        <button onclick="window.location.href='{{ route('agencies.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
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
                    <th width="15%">Action</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agencies as $agency => $result)
                    <tr>
                        <td>{{ $agency + $agencies->firstitem() }}</td>
                        <td align="center">
                            <a href="#" class="btn btn-sm btn-info" onclick="updateData('{{ $result->id }}')" data-name="{{ $result->name }}" data-desc="{{ $result->description }}" data-toggle="modal" data-target="#modalUpdateInstansi"><i class="fas fa-pen"></i></a>
                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteData('{{ $result->id }}')" data-toggle="modal" data-target="#deleteModalInstansi"><i class="fas fa-trash"></i></a>
                        </td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $agencies->links() }}
        </div>
    </div>

@endsection

@section('modal')
    <!-- Modal Insert -->
    <div class="modal fade" id="modalTambahInstansi" tabindex="-1" aria-labelledby="modalTambahInstansi" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Instansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM TAMBAH INSTANSI-->
                    <form action="{{ route('agencies.store') }}" method="post" id="form-create">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Instansi</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Instansi</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" id="reset-button" class="btn btn-secondary">Reset</button>
                    </form>
                    <!--END FORM TAMBAH INSTANSI-->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="modalUpdateInstansi" tabindex="-1"
        aria-labelledby="modalUpdateInstansi" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Instansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM UPDATE INSTANSI-->
                    <form action="javascript:void(0)" id="updateForm" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="">Nama Instansi</label>
                            <input type="text" class="form-control" id="name-ins" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Instansi</label>
                            <input type="text" class="form-control" id="description-ins" name="description" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <!--END FORM UPDATE INSTANSI-->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModalInstansi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="javascript:void(0)" id="deleteForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Hapus Instansi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#reset-button').on('click', function () {
                document.getElementById("form-create").reset();
            });

            $('#modalUpdateInstansi').on('shown.bs.modal', function (e) {
                let link  = $(e.relatedTarget);
                let name  = link.data("name");
                let desc  = link.data("desc");

                $(this).find(".modal-body #name-ins").val(name);
                $(this).find(".modal-body #description-ins").val(desc);
            });
        });

        function updateData(id) {
            let url = '{{ route("agencies.update", ":id") }}';
            url     = url.replace(':id', id);
            $("#updateForm").attr('action', url);
        }

        function deleteData(id) {
            let url = '{{ route("agencies.destroy", ":id") }}';
            url     = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endsection
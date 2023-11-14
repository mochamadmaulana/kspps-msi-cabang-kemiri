@extends('layouts.admin', ['title' => 'Komoditi Usaha','icon' => 'fas fa-store'])

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.komoditi-usaha.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus mr-1"></i> Tambah Data</a>
                @if (request('search'))
                <div class="float-right">
                    <a href="{{ route('admin.komoditi-usaha.index') }}" class="btn btn-sm btn-warning"><i class="fas fa-sync-alt mr-1"></i> Refresh</a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form action="">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Search..." autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-search mr-1"></i> Search</button>
                                </div>
                              </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tableKantor" class="table table-bordered table-hover mb-2">
                        <thead class="bg-secondary">
                            <tr>
                                <th>Komoditi</th>
                                <th>Jenis Usaha</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($komoditi_usaha->count() > 0)
                            @foreach ($komoditi_usaha as $val)
                                <tr>
                                    <td>{{ $val->nama }}</td>
                                    <td>{{ $val->jenis_usaha->kode }} | {{ $val->jenis_usaha->nama }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-xs btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('admin.komoditi-usaha.edit',$val->id) }}" class="dropdown-item"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('admin.komoditi-usaha.destroy', $val->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah yakin ingin menghapus komoditi usaha : {{ $val->nama }} ?')"><i class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center"><span class="text-muted font-italic">Data tidak ditemukan!</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <span class="float-right">{{ $komoditi_usaha->links() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item active">List Data</li>
@endpush

@push('modal')
<!-- Modal Tambah Komoditi -->
<div class="modal fade" id="ModalTambah" aria-labelledby="ModalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahLabel">Tambah Komoditi Usaha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.komoditi-usaha.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Jenis Usaha -->
                    <div class="form-group">
                        <label>Jenis Usaha <span class="text-danger">*</span></label>
                        <select name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror" id="selectUsaha"></select>
                        @error('jenis_usaha')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                    <!-- Komoditi -->
                    <div class="form-group">
                        <label>Komoditi <span class="text-danger">*</span></label>
                        <input type="text" name="komoditi" class="form-control @error('komoditi') is-invalid @enderror" placeholder="Komoditi...">
                        @error('komoditi')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Komoditi -->
<div class="modal fade" id="ModalEdit" aria-labelledby="ModalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEditLabel">Edit Komoditi Usaha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.komoditi-usaha.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Jenis Usaha -->
                    <div class="form-group">
                        <label>Jenis Usaha <span class="text-danger">*</span></label>
                        <select name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror" id="selectUsaha"></select>
                        @error('jenis_usaha')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                    <!-- Komoditi -->
                    <div class="form-group">
                        <label>Komoditi <span class="text-danger">*</span></label>
                        <input type="text" name="komoditi" class="form-control @error('komoditi') is-invalid @enderror" placeholder="Komoditi...">
                        @error('komoditi')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('js')
<script type="text/javascript">
$('#selectUsaha').select2({
    theme: 'bootstrap4',
    // placeholder: '-Pilih-'
})
function showModalTambahKomoditi(){
    $('#ModalTambah').modal('show');
    $.ajax({
        url: '/get-jenis-usaha',
        type: "GET",
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(data){
            if(data){
                $('#selectUsaha').empty();
                $('#selectUsaha').append('<option value="">- Pilih -</option>');
                $.each(data, function(key, jenisUsaha){
                    $('select[name="jenis_usaha"]').append('<option value="'+ jenisUsaha.id +'">' + jenisUsaha.kode + ' | ' + jenisUsaha.nama+ '</option>');
                });
            }else{
                $('#selectUsaha').empty();
            }
        }
    });
}
function showModalEditKomoditi(){
    $('#ModalEdit').modal('show');
    $.ajax({
        url: '/get-jenis-usaha',
        type: "GET",
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(data){
            if(data){
                $('#selectUsaha').empty();
                $('#selectUsaha').append('<option value="">- Pilih -</option>');
                $.each(data, function(key, jenisUsaha){
                    $('select[name="jenis_usaha"]').append('<option value="'+ jenisUsaha.id +'">' + jenisUsaha.kode + ' | ' + jenisUsaha.nama+ '</option>');
                });
            }else{
                $('#selectUsaha').empty();
            }
        }
    });
}
</script>
@endpush

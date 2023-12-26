@extends('layouts.staff_lapangan', ['title' => 'Majlis','icon' => 'fas fa-house-user'])

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
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
                    @if (request('search'))
                    <div class="col-md-6">
                        <div class="float-right">
                            <a href="{{ route('staff-lapangan.majlis.index') }}" class="btn btn-sm btn-warning"><i class="fas fa-sync-alt mr-1"></i> Refresh</a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table id="tableKantor" class="table table-bordered table-hover mb-2">
                        <thead class="bg-secondary">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Ketua</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Alamat</th>
                                <th>RT/RW</th>
                                <th>Tgl Berdiri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($majlis->count() > 0)
                            @foreach ($majlis as $val)
                                <tr>
                                    <td>{{ $val->kode }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td>
                                        @if ($val->ketua_id != null)
                                        {{ $val->ketua->nama_lengkap }}
                                        <a href="javascript:void(0)" class="font-italic" onclick="pilihKetua({{ $val->id }},{{ $val->kantor_id }},'{{ $val->nama_majlis }}')"><small><i class="fas fa-edit"></i></small></a>
                                        @else
                                        <a href="javascript:void(0)" class="font-italic" onclick="pilihKetua({{ $val->id }},{{ $val->kantor_id }},'{{ $val->nama_majlis }}')"><small>Pilih Ketua <i class="fas fa-pencil-alt"></i></small></a>
                                        @endif
                                    </td>
                                    <td>{{ $val->kecamatan->nama_kecamatan }}</td>
                                    <td>{{ $val->kelurahan->nama_kelurahan }}</td>
                                    <td>{{ $val->alamat }}</td>
                                    <td>{{ $val->rt_rw }}</td>
                                    <td>{{ \Carbon\Carbon::parse($val->tanggal_berdiri)->translatedFormat('d M Y') }}</td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center"><span class="text-muted font-italic">Data tidak ditemukan!</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <span class="float-right">{{ $majlis->links() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item active">List Data</li>
@endpush

@push('modal')
<!-- Modal Pilih Ketua -->
<div class="modal fade" id="PilihKetuaModal" aria-labelledby="PilihKetuaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PilihKetuaModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('staff-lapangan.majlis.pilih-ketua') }}" method="POST">
                @csrf
                <input type="hidden" name="id_majlis">
                <div class="modal-body">
                <!-- Anggota -->
                <div class="form-group">
                    <label>Pilih Ketua <span class="text-danger">*</span></label>
                    <select name="ketua" class="form-control  @error('ketua') is-invalid @enderror" id="selectKetua"></select>
                    @error('ketua')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
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
$('#selectKetua').select2({
    theme: 'bootstrap4',
    // placeholder: '-Pilih-'
})
function pilihKetua(id,id_kantor,majlis){
    var idMajlis = id;
    var idKantor = id_kantor;
    var namaMajlis = majlis;
    $('#PilihKetuaModal').modal('show');
    $('#PilihKetuaModalLabel').text('Pilih Ketua ' + namaMajlis);
    if(idMajlis) {
        $.ajax({
            url: '/get-anggota/'+idKantor+'/'+idMajlis,
            type: "GET",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(data){
                if(data){
                    $('#selectKetua').empty();
                    $('input[name="id_majlis"]').val(idMajlis);
                    $('#selectKetua').append('<option value="">- Pilih -</option>');
                    $.each(data, function(key, anggota){
                        $('select[name="ketua"]').append('<option value="'+ anggota.id +'">' + anggota.nama_lengkap+ '</option>');
                    });
                }else{
                    $('#selectKetua').empty();
                }
            }
        });
    }else{
        $('#selectKetua').empty();
    }
}
</script>
@endpush

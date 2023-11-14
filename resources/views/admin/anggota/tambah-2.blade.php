@extends('layouts.admin', ['title' => 'Tambah Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="row">
    <div class="col-lg">
        <form action="{{ route('admin.anggota.store-2',$no_pendaftaran) }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title text-bold">No. Pendaftaran : {{ $no_pendaftaran }}</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center">
                        <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap1Modal">1</a>
                        <a href="javascript:void(0)" class="badge badge-primary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap2Modal">2</a>
                        <a href="javascript:void(0)" class="badge badge-secondary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap3Modal">3</a>
                        <a href="javascript:void(0)" class="badge badge-secondary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap4Modal">4</a>
                    </h5>
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Provinsi -->
                            <div class="form-group">
                                <label>Provinsi <span class="text-danger">*</span></label>
                                <select name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" id="selectProvinsi">
                                    <option value="">- pilih -</option>
                                    @foreach ($provinsi as $val_prov)
                                    <option value="{{ $val_prov->id }}">{{ $val_prov->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kota/Kabupaten -->
                            <div class="form-group">
                                <label>Kota/Kabupaten <span class="text-danger">*</span></label>
                                <select name="kota_kabupaten" class="form-control" id="selectKotaKab" disabled></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label>Kecamatan <span class="text-danger">*</span></label>
                                <select name="kecamatan" class="form-control" id="selectKecamatan" disabled></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kelurahan -->
                            <div class="form-group">
                                <label>Kelurahan <span class="text-danger">*</span></label>
                                <select name="kelurahan" class="form-control" id="selectKelurahan" disabled></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kode Pos -->
                            <div class="form-group">
                                <label>Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" value="{{ @old('kode_pos') }}" placeholder="Kode Pos..">
                                @error('kode_pos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- RT/RW -->
                            <div class="form-group">
                                <label>RT/RW <span class="text-danger">*</span></label>
                                <input type="text" name="rt_rw" class="form-control @error('rt_rw') is-invalid @enderror" value="{{ @old('rt_rw') }}" placeholder="RT/RW..">
                                @error('rt_rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                        <!-- Alamat -->
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ @old('alamat') }}" placeholder="Alamat..">
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <button class="btn btn-md btn-block btn-primary">Simpan & Lanjutkan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Tambah ke 2</li>
@endpush

@push('modal')
<!-- Modal Tahap 1 -->
<div class="modal fade" id="Tahap1Modal" tabindex="-1" aria-labelledby="Tahap1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Tahap1ModalLabel">Tahap 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tahap 1 adalah mengisi data diri seperti <b class="font-italic">Nama Lengkap</b>, <b class="font-italic">Nama Ibu Kandung</b>, DLL..
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-secondary btn-sm">Kembali Ke Tahap 1</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tahap 2 -->
<div class="modal fade" id="Tahap2Modal" tabindex="-1" aria-labelledby="Tahap2ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Tahap2ModalLabel">Tahap 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tahap 2 adalah mengisi data alamat seperti <b class="font-italic">Provinsi</b>, <b class="font-italic">Kota/Kabupaten</b>, DLL..
            </div>
        </div>
    </div>
</div>
<!-- Modal Tahap 3 -->
<div class="modal fade" id="Tahap3Modal" tabindex="-1" aria-labelledby="Tahap3ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Tahap3ModalLabel">Tahap 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tahap 3 adalah mengisi data lampiran seperti <b class="font-italic">Foto Identitas</b>, <b class="font-italic">Foto Selfie</b>, <b class="font-italic">Foto KK (Kartu Keluarga)</b>, DLL..
            </div>
        </div>
    </div>
</div>
<!-- Modal Tahap 4 -->
<div class="modal fade" id="Tahap4Modal" tabindex="-1" aria-labelledby="Tahap4ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Tahap4ModalLabel">Tahap 4</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tahap 4 adalah tahap akhir yaitu membuat tanda tangan digital
            </div>
        </div>
    </div>
</div>
@endpush

@push('js')
<script>
$(document).ready(function (e) {
    $('#selectProvinsi').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectKotaKab').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectKecamatan').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectKelurahan').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectProvinsi').on('change', function() {
        var provID = $(this).val();
        if(provID) {
            $.ajax({
                url: '/get-kota-kabupaten/'+provID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data){
                    if(data){
                        $('#selectKotaKab').empty();
                        $('#selectKotaKab').append('<option hidden>- Pilih -</option>');
                        $('#selectKotaKab').removeAttr("disabled");
                        $.each(data, function(key, kotaKab){
                            $('select[name="kota_kabupaten"]').append('<option value="'+ kotaKab.id +'">' + kotaKab.nama_kota+ '</option>');
                        });
                    }else{
                        $('#selectKotaKab').empty();
                    }
                }
            });
        }else{
            $('#selectKotaKab').empty();
            $('#selectKotaKab').setAttr("disabled");
        }
    });
    $('#selectKotaKab').on('change', function() {
        var kotaKabID = $(this).val();
        if(kotaKabID) {
            $.ajax({
                url: '/get-kecamatan/'+kotaKabID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data){
                    if(data){
                        $('#selectKecamatan').empty();
                        $('#selectKecamatan').append('<option hidden>- Pilih -</option>');
                        $('#selectKecamatan').removeAttr("disabled");
                        $.each(data, function(key, KecKab){
                            $('select[name="kecamatan"]').append('<option value="'+ KecKab.id +'">' + KecKab.nama_kecamatan+ '</option>');
                        });
                    }else{
                        $('#selectKecamatan').empty();
                    }
                }
            });
        }else{
            $('#selectKecamatan').empty();
            $('#selectKecamatan').setAttr("disabled");
        }
    });
    $('#selectKecamatan').on('change', function() {
        var kecID = $(this).val();
        if(kecID) {
            $.ajax({
                url: '/get-kelurahan/'+kecID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data){
                    if(data){
                        $('#selectKelurahan').empty();
                        $('#selectKelurahan').append('<option hidden>- Pilih -</option>');
                        $('#selectKelurahan').removeAttr("disabled");
                        $.each(data, function(key, KelKab){
                            $('select[name="kelurahan"]').append('<option value="'+ KelKab.id +'">' + KelKab.nama_kelurahan+ '</option>');
                        });
                    }else{
                        $('#selectKelurahan').empty();
                    }
                }
            });
        }else{
            $('#selectKelurahan').empty();
            $('#selectKelurahan').setAttr("disabled");
        }
    });
});
</script>
@endpush

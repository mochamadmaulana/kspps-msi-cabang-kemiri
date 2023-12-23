@extends('layouts.admin', ['title' => 'Pendaftaran Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{ route('admin.anggota.index-pendaftaran',$nomor_daftar) }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-lg-end">
                        <h5 class="card-title">Form Input Tahap - 2</h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.anggota.store-pendaftaran-tahap-dua',$nomor_daftar) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Alamat -->
                            <div class="form-group">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ @old('alamat') }}" placeholder="Alamat..">
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
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
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-md btn-block btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index-pendaftaran',$nomor_daftar) }}">Step Pendaftaran</a></li>
<li class="breadcrumb-item active">No.{{ $nomor_daftar }}</li>
@endpush
@push('js')
<script>
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
                        $('#selectKotaKab').removeAttr("disabled");
                        $('#selectKotaKab').append('<option value="">- Pilih -</option>');
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
                        $('#selectKecamatan').append('<option value="">- Pilih -</option>');
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
                        $('#selectKelurahan').append('<option value="">- Pilih -</option>');
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
</script>
@endpush

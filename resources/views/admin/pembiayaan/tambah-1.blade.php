@extends('layouts.admin', ['title' => 'Pendaftaran Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">IDENTITAS DIRI</i></h5>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-lg-end">
                        <h5 class="card-title">No. Pendaftaran : <i class="text-bold">{{ $rc_pendaftaran->nomor_daftar }}</i></h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.anggota.store-step-1',$rc_pendaftaran->nomor_daftar) }}" method="POST">
                @csrf
                <div class="card-body">
                    <h4 class="text-center mb-3">
                        <a href="javascript:void(0)" class="badge badge-primary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap1Modal">1</a>
                        <a href="javascript:void(0)" class="badge badge-secondary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap2Modal">2</a>
                    </h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Jenis Keanggotaan -->
                            <div class="form-group">
                                <label class="form-label">Jenis Keanggotaan <span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input name="jenis_keanggotaan" class="form-check-input" type="radio" value="Majlis" id="Majlis" @if(@old('jenis_keanggotaan',$rc_pendaftaran->jenis_keanggotaan) == 'Majlis') checked @endif checked>
                                    <label class="form-check-label" for="Majlis"> Majlis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="jenis_keanggotaan" class="form-check-input" type="radio" value="Umum" id="Umum" @if(@old('jenis_keanggotaan',$rc_pendaftaran->jenis_keanggotaan) == 'Umum') checked @endif/>
                                    <label class="form-check-label" for="Umum"> Umum</label>
                                </div>
                                @error('jenis_keanggotaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Jenis Identitas -->
                            <div class="form-group">
                                <label class="form-label">Jenis Identitas <span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input name="jenis_identitas" class="form-check-input" type="radio" value="KTP" id="KTP" @if(@old('jenis_identitas') == 'KTP') checked @endif checked>
                                    <label class="form-check-label" for="KTP"> KTP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="jenis_identitas" class="form-check-input" type="radio" value="SIM" id="SIM" @if(@old('jenis_identitas') == 'SIM') checked @endif/>
                                    <label class="form-check-label" for="SIM"> SIM</label>
                                </div>
                                @error('jenis_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- No. Identitas -->
                            <div class="form-group">
                                <label>No. Identitas {{ $rc_pendaftaran->jenis_identitas }} <span class="text-danger">*</span></label>
                                <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror" value="{{ @old('no_identitas') }}" placeholder="No. Identitas {{ $rc_pendaftaran->jenis_identitas }}...">
                                @error('no_identitas')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ @old('nama_lengkap') }}" placeholder="Nama Lengkap...">
                                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Tempat Lahir -->
                            <div class="form-group">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <select name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="selectTempatLahir">
                                    <option value="">- pilih -</option>
                                    @foreach ($tempat_lahir as $val_tl)
                                    <option value="{{ $val_tl->id }}" @if (@old('tempat_lahir') == $val_tl->id) selected @endif>{{ $val_tl->nama_kota }}</option>
                                    @endforeach
                                </select>
                                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Tanggal Lahir -->
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ @old('tanggal_lahir') }}" placeholder="Tanggal Lahir...">
                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input name="jenis_kelamin" class="form-check-input" type="radio" value="Laki-Laki" id="Laki-Laki" @if(@old('jenis_kelamin') == 'Laki-Laki') checked @endif checked>
                                    <label class="form-check-label" for="Laki-Laki"> Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="jenis_kelamin" class="form-check-input" type="radio" value="Perempuan" id="Perempuan" @if(@old('jenis_kelamin') == 'Perempuan') checked @endif/>
                                    <label class="form-check-label" for="Perempuan"> Perempuan</label>
                                </div>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <select name="kota_kabupaten" class="form-control @error('kota_kabupaten') is-invalid @enderror" id="selectKotaKab" disabled></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label>Kecamatan <span class="text-danger">*</span></label>
                                <select name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" id="selectKecamatan" disabled></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kelurahan -->
                            <div class="form-group">
                                <label>Kelurahan <span class="text-danger">*</span></label>
                                <select name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror" id="selectKelurahan" disabled></select>
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
                            <!-- No. Telepone -->
                            <div class="form-group">
                                <label>No. Telepone <span class="text-danger">*</span></label>
                                <input type="text" name="no_telepone" class="form-control @error('no_telepone') is-invalid @enderror" value="{{ @old('no_telepone') }}" placeholder="No. Telepone...">
                                @error('no_telepone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Pendidikan Terakhir -->
                            <div class="form-group">
                                <label>Pendidikan Terakhir <span class="text-danger">*</span></label>
                                <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="selectPendidikanTerakhir">
                                    <option value="">- pilih -</option>
                                    <option value="Tidak Bersekolah" @if (@old('pendidikan_terakhir') == 'Tidak Bersekolah') selected @endif>Tidak Bersekolah</option>
                                    <option value="SD" @if (@old('pendidikan_terakhir') == 'SD') selected @endif>SD</option>
                                    <option value="SMP" @if (@old('pendidikan_terakhir') == 'SMP') selected @endif>SMP</option>
                                    <option value="SMA" @if (@old('pendidikan_terakhir') == 'SMA') selected @endif>SMA</option>
                                    <option value="D3" @if (@old('pendidikan_terakhir') == 'D3') selected @endif>Diploma 3</option>
                                    <option value="Sarjana 1" @if (@old('pendidikan_terakhir') == 'Sarjana 1') selected @endif>Sarjana 1</option>
                                    <option value="Sarjana 2" @if (@old('pendidikan_terakhir') == 'Sarjana 2') selected @endif>Sarjana 2</option>
                                    <option value="Sarjana 3" @if (@old('pendidikan_terakhir') == 'Sarjana 3') selected @endif>Sarjana 3</option>
                                </select>
                                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Agama -->
                            <div class="form-group">
                                <label>Agama <span class="text-danger">*</span></label>
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="">- pilih -</option>
                                    <option value="Islam" @if (@old('agama') == 'Islam') selected @endif>Islam</option>
                                    <option value="Hindu" @if (@old('agama') == 'Hindu') selected @endif>Hindu</option>
                                    <option value="Budha" @if (@old('agama') == 'Budha') selected @endif>Budha</option>
                                    <option value="Protestan" @if (@old('agama') == 'Protestan') selected @endif>Protestan</option>
                                    <option value="Katolik" @if (@old('agama') == 'Katolik') selected @endif>Katolik</option>
                                    <option value="Khonghucu" @if (@old('agama') == 'Khonghucu') selected @endif>Khonghucu</option>
                                </select>
                                @error('agama')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Status Pernikahan -->
                            <div class="form-group">
                                <label>Status Pernikahan <span class="text-danger">*</span></label>
                                <select name="status_pernikahan" class="form-control @error('status_pernikahan') is-invalid @enderror" id="selectStatusPernikahan">
                                    <option value="">- pilih -</option>
                                    <option value="Belum Menikah" @if (@old('status_pernikahan') == 'Belum Menikah') selected @endif>Belum Menikah</option>
                                    <option value="Nikah" @if (@old('status_pernikahan') == 'Nikah') selected @endif>Nikah</option>
                                    <option value="Cerai" @if (@old('status_pernikahan') == 'Cerai') selected @endif>Cerai</option>
                                    <option value="Janda/Duda" @if (@old('status_pernikahan') == 'Janda/Duda') selected @endif>Janda/Duda</option>
                                </select>
                                @error('status_pernikahan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Nama Ibu Kandung -->
                            <div class="form-group">
                                <label>Nama Ibu Kandung <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu_kandung" class="form-control @error('nama_ibu_kandung') is-invalid @enderror" value="{{ @old('nama_ibu_kandung') }}" placeholder="Nama Ibu Kandung...">
                                @error('nama_ibu_kandung')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Majlis -->
                            <div class="form-group">
                                <label>Majlis <span class="text-danger">*</span></label>
                                <select name="majlis" class="form-control @error('majlis') is-invalid @enderror" id="selectMajlis">
                                    <option value="">- pilih -</option>
                                    @foreach ($majlis as $val_majlis)
                                    <option value="{{ $val_majlis->id }}" @if (@old('majlis') == $val_majlis->id) selected @endif>{{ $val_majlis->kode }} | {{ $val_majlis->nama }}</option>
                                    @endforeach
                                </select>
                                @error('majlis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Jenis Usaha -->
                            <div class="form-group">
                                <label>Jenis Usaha <span class="text-danger">*</span></label>
                                <select name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror" id="selectJenisUsaha">
                                    <option value="">- pilih -</option>
                                    @foreach ($jenis_usaha as $val_jenis_usaha)
                                    <option value="{{ $val_jenis_usaha->id }}">{{ $val_jenis_usaha->kode }} | {{ $val_jenis_usaha->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_usaha')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Komoditi Usaha -->
                            <div class="form-group">
                                <label>Komoditi Usaha <span class="text-danger">*</span></label>
                                <select name="komoditi_usaha" class="form-control @error('komoditi_usaha') is-invalid @enderror" id="selectKomoditi">
                                    <option value="">- pilih -</option>
                                </select>
                                @error('komoditi_usaha')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Nonimal Bayar -->
                            <div class="form-group">
                                <label>Nominal Bayar Daftar <span class="text-danger">* <sup class="font-italic">Rp. 50.000</sup></span></label>
                                <input type="text" name="nominal_bayar_daftar" class="form-control @error('nominal_bayar_daftar') is-invalid @enderror" value="{{ @old('nominal_bayar_daftar') }}" placeholder="Nominal Bayar Daftar...">
                                @error('nominal_bayar_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Metode Bayar Pendaftaran -->
                            <div class="form-group">
                                <label>Metode Bayar daftar <span class="text-danger">*</label><br>
                                <div class="form-check form-check-inline">
                                    <input name="metode_bayar_daftar" class="form-check-input" type="radio" value="Cash" id="Cash" @if(@old('metode_bayar_daftar') == 'Cash') checked @endif checked>
                                    <label class="form-check-label" for="Cash"> Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="metode_bayar_daftar" class="form-check-input" type="radio" value="Transfer" id="Transfer" @if(@old('metode_bayar_daftar') == 'Transfer') checked @endif/>
                                    <label class="form-check-label" for="Transfer"> Transfer</label>
                                </div>
                                @error('metode_bayar_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-md btn-block btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Pendaftaran</li>
<li class="breadcrumb-item active">Tahap 1</li>
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
                Tahap 1 adalah mengisi data diri seperti <b class="font-italic">Nomor Identitas KTP/SIM, Nama Lengkap</b>, DLL..
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
                Tahap 2 adalah <b class="font-italic"> Mengupload Lampiran</b> yang diperlukan seperti <b class="font-italic">Upload KTP/SIM, Selfie KTP/SIM</b>, DLL...
            </div>
        </div>
    </div>
</div>
@endpush

@push('js')
<script>
$(document).ready(function (e) {
    $('#selectTempatLahir').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectMajlis').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectJenisUsaha').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
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
    $('#selectKomoditi').select2({
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
    $('#selectJenisUsaha').on('change', function() {
        var jenisUsahaID = $(this).val();
        if(jenisUsahaID) {
            $.ajax({
                url: '/get-komoditi-usaha/'+jenisUsahaID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data){
                    if(data){
                        $('#selectKomoditi').empty();
                        $('#selectKomoditi').append('<option value="">- pilih -</option>');
                        $('#selectKomoditi').removeAttr("disabled");
                        $.each(data, function(key, komoditi){
                            $('select[name="komoditi_usaha"]').append('<option value="'+ komoditi.id +'">' + komoditi.nama+ '</option>');
                        });
                    }else{
                        $('#selectKomoditi').empty();
                    }
                }
            });
        }else{
            $('#selectKomoditi').empty();
            $('#selectKomoditi').setAttr("disabled");
        }
    });
});
</script>
@endpush

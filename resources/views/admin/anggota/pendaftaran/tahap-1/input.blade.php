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
                        <h5 class="card-title">Form Input Tahap - 1</h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.anggota.store-pendaftaran-tahap-satu',$nomor_daftar) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jenis Keanggotaan <span class="text-danger">*</span></label>
                                <select name="jenis_keanggotaan" class="form-control @error('jenis_keanggotaan') is-invalid @enderror">
                                    <option value="">- pilih -</option>
                                    <option value="Majlis" @if (@old('jenis_keanggotaan') == 'Majlis') selected @endif>Majlis</option>
                                    <option value="Umum" @if (@old('jenis_keanggotaan') == 'Umum') selected @endif>Umum</option>
                                </select>
                                @error('jenis_keanggotaan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                            <div class="form-group">
                                <label>No. Kartu Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_kartu_keluarga" class="form-control @error('nomor_kartu_keluarga') is-invalid @enderror" value="{{ @old('nomor_kartu_keluarga') }}" placeholder="No. Kartu Keluarga...">
                                @error('nomor_kartu_keluarga')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jenis Identitas <span class="text-danger">*</span></label>
                                <select name="jenis_identitas" class="form-control @error('jenis_identitas') is-invalid @enderror">
                                    <option value="">- pilih -</option>
                                    <option value="KTP" @if (@old('jenis_identitas') == 'KTP') selected @endif>KTP</option>
                                    <option value="SIM" @if (@old('jenis_identitas') == 'SIM') selected @endif>SIM</option>
                                </select>
                                @error('jenis_identitas')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>No. Identitas <span class="text-danger">* <sup class="font-italic">KTP/SIM</sup></span></label>
                                <input type="text" name="nomor_identitas" class="form-control @error('nomor_identitas') is-invalid @enderror" value="{{ @old('nomor_identitas') }}" placeholder="No. KTP/SIM...">
                                @error('nomor_identitas')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">* <sup class="font-italic">Nama di KTP/SIM.</span></sup></label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ @old('nama_lengkap') }}" placeholder="Nama Lengkap...">
                                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ @old('tanggal_lahir') }}" placeholder="Tanggal Lahir...">
                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">- pilih -</option>
                                    <option value="Laki-Laki" @if (@old('jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                    <option value="Perempuan" @if (@old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ @old('email') }}" placeholder="Email...">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>No. Telepone <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_telepone" class="form-control @error('nomor_telepone') is-invalid @enderror" value="{{ @old('nomor_telepone') }}" placeholder="No. Telepone...">
                                @error('nomor_telepone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                            <div class="form-group">
                                <label>Nama Ibu Kandung <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu_kandung" class="form-control @error('nama_ibu_kandung') is-invalid @enderror" value="{{ @old('nama_ibu_kandung') }}" placeholder="Nama Ibu Kandung...">
                                @error('nama_ibu_kandung')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jenis Usaha <span class="text-danger">*</span></label>
                                <select name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror" id="selectJenisUsaha">
                                    <option value="">- pilih -</option>
                                    @foreach ($jenis_usaha as $val_ju)
                                    <option value="{{ $val_ju->id }}" @if (@old('jenis_usaha') == $val_ju->id) selected @endif>{{ $val_ju->kode }} | {{ $val_ju->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_usaha')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Komoditi Usaha <span class="text-danger">*</span></label>
                                <select name="komoditi_usaha" class="form-control @error('komoditi_usaha') is-invalid @enderror" id="selectKomoditi" disabled></select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Deskripsi Usaha</label>
                                <input type="text" name="deskripsi_usaha" class="form-control @error('deskripsi_usaha') is-invalid @enderror" value="{{ @old('deskripsi_usaha') }}" placeholder="Deskripsi Usaha...">
                                @error('deskripsi_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nominal Bayar Daftar <span class="text-danger">* <sup class="font-italic">Rp.50.000</sup></span></label>
                                <input type="text" name="nominal_bayar_daftar" class="form-control @error('nominal_bayar_daftar') is-invalid @enderror" value="{{ @old('nominal_bayar_daftar') }}" placeholder="0">
                                @error('nominal_bayar_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Metode Bayar Daftar <span class="text-danger">*</span></label>
                                <select name="metode_bayar_daftar" class="form-control @error('metode_bayar_daftar') is-invalid @enderror">
                                    <option value="">- pilih -</option>
                                    <option value="Cash" @if (@old('metode_bayar_daftar') == 'Cash') selected @endif>Cash</option>
                                    <option value="Transfer" @if (@old('metode_bayar_daftar') == 'Transfer') selected @endif>Transfer</option>
                                </select>
                                @error('metode_bayar_daftar')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
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
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index-pendaftaran',$nomor_daftar) }}">Tahap Pendaftaran</a></li>
<li class="breadcrumb-item active">No.{{ $nomor_daftar }}</li>
@endpush

@push('js')
<script>
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
    $('#selectKomoditi').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
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
</script>
@endpush

@extends('layouts.admin', ['title' => 'Pendaftaran Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="row">
    <div class="col-12" id="accordion">
        {{-- Tahap - 1 --}}
        <div class="card">
            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                <div class="card-header">
                    <h4 class="card-title @if(!empty($pendaftaran->tahap_satu)) text-success @endif w-100">
                        <i class="fas fa-layer-group mr-1"></i> Tahap ke 1 @if(!empty($pendaftaran->tahap_satu)) <i class="ml-2 text-sm fas fa-check"></i> @endif
                    </h4>
                </div>
            </a>
            <div id="collapseOne" class="collapse @if(empty($pendaftaran->tahap_satu)) show @endif" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <strong>Jenis Keanggotaan</strong>
                            <p class="font-italic">{{ $anggota->jenis_keanggotaan ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Majlis</strong>
                            <p class="font-italic">
                                @if (!empty($anggota->majlis_id))
                                {{ $anggota->majlis->kode . ' | ' . $anggota->majlis->nama }}
                                @else
                                ...
                                @endif
                            </p>
                        </div>

                        <div class="col-lg-4">
                            <strong>No. Kartu Keluarga</strong>
                            <p class="font-italic">{{ $anggota->nomor_kartu_keluarga ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Jenis Identitas</strong>
                            <p class="font-italic">{{ $anggota->jenis_identitas ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>No. Identitas</strong>
                            <p class="font-italic">{{ $anggota->nomor_identitas ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Nama Lengkap</strong>
                            <p class="font-italic">{{ $anggota->nama_lengkap ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Tempat, Tanggal-Lahir</strong>
                            <p class="font-italic">
                                @if (!empty($anggota->tempat_lahir_id))
                                {{ $anggota->tempat_lahir->nama_kota . ', ' . \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d-m-Y') }}
                                @else
                                ...
                                @endif
                            </p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Jenis Kelamin</strong>
                            <p class="font-italic">{{ $anggota->jenis_kelamin ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Email</strong>
                            <p class="font-italic">{{ $anggota->email ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Nomor Telepone</strong>
                            <p class="font-italic">{{ $anggota->nomor_telepone ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Agama</strong>
                            <p class="font-italic">{{ $anggota->agama ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Status Pernikahan</strong>
                            <p class="font-italic">{{ $anggota->status_pernikahan ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Pendidikan Terakhir</strong>
                            <p class="font-italic">{{ $anggota->pendidikan_terakhir ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Nama Ibu Kandung</strong>
                            <p class="font-italic">{{ $anggota->nama_ibu_kandung ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Nominal Bayar Daftar</strong>
                            <p class="font-italic">{{ number_format($anggota->pendaftaran_anggota->nominal_bayar_daftar, 2) ?? '...' }}</p>
                        </div>

                        <div class="col-lg-4">
                            <strong>Metode Bayar Daftar</strong>
                            <p class="font-italic">{{ $anggota->pendaftaran_anggota->metode_bayar_daftar ?? '...' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if (empty($pendaftaran->tahap_satu))
                    <a href="{{ route('admin.anggota.input-pendaftaran-tahap-satu',$pendaftaran->nomor_daftar) }}" class="btn btn-sm btn-primary ml-1"><i class="fas fa-pencil-alt mx-1"></i> Input</a>
                    @else
                    <a href="{{ route('admin.anggota.edit-pendaftaran-tahap-satu',$pendaftaran->nomor_daftar) }}" class="btn btn-sm btn-success ml-1"><i class="fas fa-edit mx-1"></i> Edit</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Tahap - 2 --}}
        <div class="card">
            <a class="d-block w-100" data-toggle="collapse" href="#collapseTree">
                <div class="card-header">
                    <h4 class="card-title @if(!empty($pendaftaran->tahap_dua)) text-success @endif w-100">
                        <i class="fas fa-layer-group mr-1"></i> Tahap ke 2 @if(!empty($pendaftaran->tahap_dua)) <i class="ml-2 text-sm fas fa-check"></i> @endif
                    </h4>
                </div>
            </a>
            <div id="collapseTree" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    @if (!empty($pendaftaran->tahap_satu))
                    <div class="row">
                        <div class="col-lg-6">
                            <strong>Alamat {{ $anggota->jenis_identitas ?? '' }}</strong>
                            <p class="font-italic">{{ $alamat_identitas->alamat ?? '...' }}</p>
                        </div>

                        <div class="col-lg-6">
                            <strong>Provinsi</strong>
                            <p class="font-italic">{{ $alamat_identitas->provinsi->nama_provinsi ?? '...' }}</p>
                        </div>

                        <div class="col-lg-6">
                            <strong>Kota/Kabupaten</strong>
                            <p class="font-italic">{{ $alamat_identitas->kota->nama_kota ?? '...' }}</p>
                        </div>

                        <div class="col-lg-6">
                            <strong>Kecamatan</strong>
                            <p class="font-italic">{{ $alamat_identitas->kecamatan->nama_kecamatan ?? '...' }}</p>
                        </div>

                        <div class="col-lg-6">
                            <strong>Kelurahan</strong>
                            <p class="font-italic">{{ $alamat_identitas->kelurahan->nama_kelurahan ?? '...' }}</p>
                        </div>

                        <div class="col-lg-6">
                            <strong>Kode Pos</strong>
                            <p class="font-italic">{{ $alamat_identitas->kode_pos ?? '...' }}</p>
                        </div>

                        <div class="col-lg-6">
                            <strong>RT/RW</strong>
                            <p class="font-italic">{{ $alamat_identitas->rt_rw ?? '...' }}</p>
                        </div>
                    </div>
                    @else
                    <span>Harap lengkapi terlebih dahulu tahap ke - 1</span>
                    @endif
                </div>
                @if (!empty($pendaftaran->tahap_satu))
                    <div class="card-footer">
                        @if (empty($pendaftaran->tahap_dua))
                        <a href="{{ route('admin.anggota.input-pendaftaran-tahap-dua',$pendaftaran->nomor_daftar) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt mx-1"></i> Input</a>
                        @else
                        <a href="{{ route('admin.anggota.edit-pendaftaran-tahap-dua',$pendaftaran->nomor_daftar) }}" class="btn btn-sm btn-success"><i class="fas fa-edit mx-1"></i> Edit</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Tahap - 3 --}}
        <div class="card">
            <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <i class="fas fa-layer-group mr-1"></i> Tahap ke 3
                    </h4>
                </div>
            </a>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    @if(!empty($pendaftaran->tahap_dua))
                        <div class="row">
                            <label class="col-lg col-form-label">File Identitas {{ $anggota->jenis_identitas }} <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                            <div class="col-lg-8">
                                @if ($anggota->file_identitas != null)
                                    <a href="{{ asset('storage/galery-file/anggota/'.$anggota->file_identitas) }}" target="_blank">File Identitas {{ $anggota->jenis_identitas }} <i class="fas fa-eye"></i></a>
                                    <form action="{{ route('admin.anggota.pendaftaran-destroy-file-identitas',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file identitas?')"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                @else
                                <form action="{{ route('admin.anggota.pendaftaran-upload-file-identitas',$anggota->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file_identitas" class="custom-file-input @error('file_identitas') is-invalid @enderror" id="identitasFile">
                                                <label class="custom-file-label label-file-identitas" for="identitasFile">Pilih file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="submit"><i class="fas fa-upload mx-1"></i></button>
                                            </div>
                                        </div>
                                        @error('file_identitas')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg col-form-label">File Selfie Identitas {{ $anggota->jenis_identitas }} <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    @if ($anggota->file_selfie_identitas != null)
                                        <a href="{{ asset('storage/galery-file/anggota/'.$anggota->file_selfie_identitas) }}" target="_blank">File Selfie Identitas {{ $anggota->jenis_identitas }} <i class="fas fa-eye"></i></a>
                                        <form action="{{ route('admin.anggota.pendaftaran-destroy-file-selfie-identitas',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file selfie identitas?')"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    @else
                                    <form action="{{ route('admin.anggota.pendaftaran-upload-file-selfie-identitas',$anggota->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="file_selfie_identitas" class="custom-file-input @error('file_selfie_identitas') is-invalid @enderror" id="selfieIdentitasFile">
                                                    <label class="custom-file-label label-file-selfie-identitas" for="selfieIdentitasFile">Pilih file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning" type="submit"><i class="fas fa-upload mx-1"></i></button>
                                                </div>
                                            </div>
                                            @error('file_selfie_identitas')<small class="text-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg col-form-label">File Kartu Keluarga <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                            <div class="col-lg-8">
                                @if ($anggota->file_kartu_keluarga != null)
                                    <a href="{{ asset('storage/image/anggota/'.$anggota->file_kartu_keluarga) }}" target="_blank">File Kartu Keluarga <i class="fas fa-eye"></i></a>
                                    <form action="{{ route('admin.anggota.pendaftaran-destroy-file-kartu-keluarga',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file kartu keluarga?')"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                @else
                                <form action="{{ route('admin.anggota.pendaftaran-upload-file-kartu-keluarga',$anggota->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file_kartu_keluarga" class="custom-file-input @error('file_kartu_keluarga') is-invalid @enderror" id="kartuKeluargaFile">
                                                <label class="custom-file-label label-file-kartu-keluarga" for="kartuKeluargaFile">Pilih file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="submit"><i class="fas fa-upload mx-1"></i></button>
                                            </div>
                                        </div>
                                        @error('file_kartu_keluarga')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg col-form-label">File Foto Usaha <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                            <div class="col-lg-8">
                                @if ($anggota->foto_usaha != null)
                                    <a href="{{ asset('storage/image/anggota/'.$anggota->foto_usaha) }}" target="_blank">File Foto Usaha <i class="fas fa-eye"></i></a>
                                    <form action="{{ route('admin.anggota.pendaftaran-destroy-file-kartu-keluarga',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file foto usaha ?')"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                @else
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="file_foto_usaha" class="custom-file-input @error('file_foto_usaha') is-invalid @enderror" id="fotoUsahaFile">
                                            <label class="custom-file-label label-file-foto-usaha" for="fotoUsahaFile">Pilih file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="submit"><i class="fas fa-upload mx-1"></i></button>
                                        </div>
                                    </div>
                                    @error('file_foto_usaha')<small class="text-danger">{{ $message }}</small>@enderror
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg col-form-label">Foto Bukti Bayar Pendaftaran <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                            <div class="col-lg-8">
                                @if ($pendaftaran->bukti_bayar_daftar != null)
                                    <a href="{{ asset('storage/image/anggota/'.$pendaftaran->bukti_bayar) }}" target="_blank">Foto Bukti Bayar Pendaftaran <i class="fas fa-eye"></i></a>
                                    <form action="#" method="POST" class="d-inline ml-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus foto bukti bayar pendaftaran ?')"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                @else
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-4">
                                        <div class="custom-file">
                                            <input type="file" name="foto_bukti_bayar_daftar" class="custom-file-input @error('foto_bukti_bayar_daftar') is-invalid @enderror" id="buktiBayarDaftarFile">
                                            <label class="custom-file-label label-foto-bukti-bayar-daftar" for="buktiBayarDaftarFile">Pilih file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="submit"><i class="fas fa-upload mx-1"></i></button>
                                        </div>
                                    </div>
                                    @error('foto_bukti_bayar_daftar')<small class="text-danger">{{ $message }}</small>@enderror
                                </form>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if(empty($pendaftaran->tahap_dua))
                    <span>Harap lengkapi terlebih dahulu tahap ke - 2</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">List Data</a></li>
<li class="breadcrumb-item active">No.{{ $pendaftaran->nomor_daftar }}</li>
@endpush
@push('js')
<script>
    $('#selectMajlis').select2({
        theme: 'bootstrap4',
    })
    $('input[name="file_identitas"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.label-file-identitas').html(fileName);
    });
    $('input[name="file_selfie_identitas"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.label-file-selfie-identitas').html(fileName);
    });
    $('input[name="file_kartu_keluarga"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.label-file-kartu-keluarga').html(fileName);
    });
    $('input[name="file_foto_usaha"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.label-file-foto-usaha').html(fileName);
    });
    $('input[name="foto_bukti_bayar_daftar"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.label-foto-bukti-bayar-daftar').html(fileName);
    });
</script>
@endpush

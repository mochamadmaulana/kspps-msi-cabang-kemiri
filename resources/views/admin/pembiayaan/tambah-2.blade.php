@extends('layouts.admin', ['title' => 'Pendaftaran Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">LAMPIRAN</i></h5>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-lg-end">
                        <h5 class="card-title">No. Pendaftaran : <i class="text-bold">{{ $rc_pendaftaran->nomor_daftar }}</i></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="text-center mb-3">
                    <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap1Modal">1</a>
                    <a href="javascript:void(0)" class="badge badge-primary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap2Modal">2</a>
                </h4>
                <div class="row">
                    <label class="col-lg col-form-label">File Identitas {{ $anggota->jenis_identitas }} <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                    <div class="col-lg-8">
                        @if ($anggota->foto_identitas != null)
                            <a href="{{ asset('storage/image/anggota/'.$anggota->foto_identitas) }}" target="_blank">File Identitas {{ $anggota->jenis_identitas }} <i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.anggota.delete-identitas',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file identitas ?')"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        @else
                        <form action="{{ route('admin.anggota.upload-identitas',$anggota->id) }}" method="POST" enctype="multipart/form-data">
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
                            @if ($anggota->foto_selfie_identitas != null)
                                <a href="{{ asset('storage/image/anggota/'.$anggota->foto_selfie_identitas) }}" target="_blank">File Selfie Identitas {{ $anggota->jenis_identitas }} <i class="fas fa-eye"></i></a>
                                <form action="{{ route('admin.anggota.delete-selfie-identitas',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file selfie identitas ?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            @else
                            <form action="{{ route('admin.anggota.upload-selfie-identitas',$anggota->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-lg col-form-label">File Kartu Keluarga <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                    <div class="col-lg-8">
                        @if ($anggota->foto_kartu_keluarga != null)
                            <a href="{{ asset('storage/image/anggota/'.$anggota->foto_kartu_keluarga) }}" target="_blank">File Kartu Keluarga <i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.anggota.delete-kartu-keluarga',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file kartu keluarga ?')"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        @else
                        <form action="{{ route('admin.anggota.upload-kartu-keluarga',$anggota->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="file_kartu_keluarga" class="custom-file-input @error('file_kartu_keluarga') is-invalid @enderror" id="kartuKeluargaFile">
                                    <label class="custom-file-label label-file-kartu-keluarga" for="kartuKeluargaFile">Pilih file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="submit"><i class="fas fa-upload mx-1"></i></button>
                                </div>
                            </div>
                            @error('file_kartu_keluarga')<small class="text-danger">{{ $message }}</small>@enderror
                        </form>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg col-form-label">File Foto Usaha <span class="text-danger">*<br><sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span></label>
                    <div class="col-lg-8">
                        @if ($anggota->foto_usaha != null)
                            <a href="{{ asset('storage/image/anggota/'.$anggota->foto_usaha) }}" target="_blank">File Foto Usaha <i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.anggota.delete-foto-usaha',$anggota->id) }}" method="POST" class="d-inline ml-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus file foto usaha ?')"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        @else
                        <form action="{{ route('admin.anggota.upload-foto-usaha',$anggota->id) }}" method="POST" enctype="multipart/form-data">
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
                        @if ($rc_pendaftaran->bukti_bayar_daftar != null)
                            <a href="{{ asset('storage/image/anggota/'.$rc_pendaftaran->bukti_bayar) }}" target="_blank">Foto Bukti Bayar Pendaftaran <i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.anggota.delete-foto-bukti-bayar-daftar',$rc_pendaftaran->nomor_daftar) }}" method="POST" class="d-inline ml-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus foto bukti bayar pendaftaran ?')"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        @else
                        <form action="{{ route('admin.anggota.upload-foto-bukti-bayar-daftar',$rc_pendaftaran->nomor_daftar) }}" method="POST" enctype="multipart/form-data">
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
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{ route('admin.anggota.edit-step-1',$rc_pendaftaran->nomor_daftar) }}" class="btn btn-md btn-block btn-secondary">Kembali Tahap 1</a>
                    </div>
                    @if (!empty($anggota->foto_identitas) && !empty($anggota->foto_selfie_identitas) && !empty($anggota->foto_kartu_keluarga) && !empty($anggota->foto_usaha) && !empty($rc_pendaftaran->bukti_bayar_daftar))
                    <div class="col-lg-6">
                        <form action="{{ route('admin.anggota.submit-pendaftaran',$rc_pendaftaran->nomor_daftar) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-md btn-block btn-primary" onclick="return confirm('Apakah yakin ingin mensubmit pendaftaran ?')">Submit</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
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
            <div class="card-footer">
                <a href="{{ route('admin.anggota.edit-step-1',$rc_pendaftaran->nomor_daftar) }}" class="btn btn-secondary btn-sm">Kembali Tahap 1</a>
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
<script type="text/javascript">
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

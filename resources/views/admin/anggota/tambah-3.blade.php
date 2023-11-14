@extends('layouts.admin', ['title' => 'Tambah Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h4 class="text-center font-italic">Lampiran</h3>
                <h4 class="text-center">
                    <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap1Modal">1</a>
                    <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap2Modal">2</a>
                    <a href="javascript:void(0)" class="badge badge-primary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap3Modal">3</a>
                    <a href="javascript:void(0)" class="badge badge-secondary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap4Modal">4</a>
                </h5>
                <form action="{{ route('admin.anggota.store-3',$no_pendaftaran) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Pilih File -->
                            <div class="form-group">
                                <label>Pilih File <span class="text-danger">* <sup class="font-italic">jpg, jpeg, png, pdf (max 10240)</sup></span>
                                </label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                                    <label class="custom-file-label label-file" for="customFile">Choose file</label>
                                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Upload -->
                            <div class="form-group">
                                <label>Upload <span class="text-danger">*</span></label>
                                <select name="upload" class="form-control @error('upload') is-invalid @enderror" id="selectProvinsi">
                                    <option value="">- pilih -</option>
                                    <option value="identitas" @if(@old('upload') == 'identitas') selected @endif>Identitas KTP/SIM</option>
                                    <option value="selfie_identitas" @if(@old('upload') == 'selfie_identitas') selected @endif>Selfie Identitas KTP/SIM</option>
                                    <option value="kartu_keluarga" @if(@old('upload') == 'kartu_keluarga') selected @endif>Kartu Keluarga</option>
                                    <option value="usaha" @if(@old('upload') == 'usaha') selected @endif>Usaha</option>
                                    <option value="bukti_bayar_pendaftaran" @if(@old('upload') == 'bukti_bayar_pendaftaran') selected @endif>Bukti Bayar Pendaftaran</option>
                                </select>
                                @error('upload')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-md btn-block btn-primary shadow-sm">Simpan & Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Tambah Tahap 3</li>
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
    $('input[name="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.label-file').html(fileName);
    });
});
</script>
@endpush

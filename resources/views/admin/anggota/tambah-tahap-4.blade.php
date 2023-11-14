@extends('layouts.admin', ['title' => 'Tambah Anggota','icon' => 'fas fa-address-book'])
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h4 class="text-center font-italic">Tanda Tangan Digital</h3>
                <h4 class="text-center">
                    <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap1Modal">1</a>
                    <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap2Modal">2</a>
                    <a href="javascript:void(0)" class="badge badge-success rounded-pill mx-1" data-toggle="modal" data-target="#Tahap3Modal">3</a>
                    <a href="javascript:void(0)" class="badge badge-primary rounded-pill mx-1" data-toggle="modal" data-target="#Tahap4Modal">4</a>
                </h5>
                {{-- <form action="{{ route('admin.anggota.store-tahap-4',$no_pendaftaran) }}" method="POST" enctype="multipart/form-data"> --}}
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Tanda Tangan Digital -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanda Tangan Digital <span class="text-danger">*</span></label><br>
                                <div id="sig"></div>
                                <textarea name="tanda_tangan_digital" class="form-control" id="tanda-tangan-digital" style="display: none" cols="5" rows="5"></textarea><br>
                                <button type="button" class="btn btn-sm btn-danger" id="clear-pad">Clear</button>
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
<li class="breadcrumb-item active">Tambah Tahap 4</li>
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

@push('css')
<!-- Jquery UI -->
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}">
<!-- Signature Pad -->
<link rel="stylesheet" href="{{ asset('assets/plugins/signature-pad/css/jquery.signature.css') }}">
<style>
    .kbw-signature { width: 100%; height: 200px; }
    #sig.canvas{
        width: 100% !important;
        height: auto;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery.ui.touch-punch.js') }}"></script>
<script src="{{ asset('assets/plugins/signature-pad/js/jquery.signature.js') }}"></script>

<script type="text/javascript">
var sig = $('#sig').signature({
    syncField: '#tanda-tangan-digital',
    background: '#ffffff00',
    syncFormat: 'PNG'
}).draggable();
$('#clear-pad').click(function(e) {
    e.preventDefault();
    sig.signature('clear');
    $('#tanda-tangan-digital').val('');
});
</script>
@endpush

@extends('layouts.admin', ['title' => 'Kantor','icon' => 'fas fa-building'])

@section('content')
<div class="row mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Foto Kantor</h4>
                    </div>
                    <div class="card-body">
                        @if ($kantor->foto == null)
                        <img src="{{ asset('assets/dist/img/photo1.png') }}" class="d-block w-100 img-rounded" alt="{{ $kantor->nama }}-1">
                        @else
                        <img src="{{ asset('storage/image/kantor/'. $kantor->uuid . '/' . $kantor->foto) }}" class="d-block w-100 img-rounded" alt="{{ $kantor->nama }}-1">
                        @endif
                    </div>
                    <div class="card-footer">
                        @if ($kantor->foto == null)
                        <a href="javascript:void(0)" class="btn btn-md btn-block btn-primary mt-2" data-toggle="modal" data-target="#UploadFotoModal">Upload Foto</a>
                        @else
                        <a href="javascript:void(0)" class="btn btn-md btn-block btn-success mt-2" data-toggle="modal" data-target="#EditFotoModal">Edit Foto</a>
                        <form action="{{ route('admin.kantor.delete-foto',$kantor->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-md btn-block btn-danger mt-1" onclick="return confirm('Apakah yakin ingin menghapus foto kantor ?')">Hapus Foto</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Kantor</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Jenis Kantor</span>
                                    <span class="col-lg">Cabang</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Kode</span>
                                    <span class="col-lg">{{ $kantor->kode }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Nama Kantor</span>
                                    <span class="col-lg">{{ $kantor->nama }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">No. Telepone</span>
                                    <span class="col-lg">{{ $kantor->no_telepone }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Email</span>
                                    <span class="col-lg">{{ $kantor->email }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Alamat</span>
                                    <span class="col-lg">{{ $kantor->alamat }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Provinsi</span>
                                    <span class="col-lg">{{ \GHelp::str_ucfirst($kantor->provinsi->nama_provinsi) }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Kota/Kabupaten</span>
                                    <span class="col-lg">{{ \GHelp::str_ucfirst($kantor->kota_kab->nama_kota) }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Kecamatan</span>
                                    <span class="col-lg">{{ \GHelp::str_ucfirst($kantor->kecamatan->nama_kecamatan) }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Desa/Kelurahan</span>
                                    <span class="col-lg">{{ \GHelp::str_ucfirst($kantor->kelurahan->nama_kelurahan) }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">RT/RW</span>
                                    <span class="col-lg">{{ $kantor->rt_rw }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Jumlah Karyawan</span>
                                    <span class="col-lg">{{ $jumlah_karyawan }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-lg-5 text-bold">Brance Manager</span>
                                    <span class="col-lg">{{ $branch_manager->nama_lengkap ?? '-' }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.kantor.edit',$kantor->id) }}" class="btn btn-md btn-block btn-success mt-2">Edit Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item active">Detail</li>
@endpush

@push('modal')
@if($kantor->foto == null)
<!-- Modal Upload Foto -->
<div class="modal fade" id="UploadFotoModal" tabindex="-1" aria-labelledby="UploadFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadFotoModalLabel">Upload Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kantor.upload-foto',$kantor->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- File Foto Upload -->
                    <div class="form-group">
                        <label>File Foto Upload <span class="text-danger">*</span><br>
                            <sup class="text-danger font-italic">jpg, jpeg, png</sup>
                        </label>
                        <div class="custom-file">
                            <input type="file" name="file_foto_upload" class="custom-file-input @error('file_foto_upload') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label label-file-foto-upload" for="customFile">Choose file</label>
                            @error('file_foto_upload')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<!-- Modal Edit Foto -->
<div class="modal fade" id="EditFotoModal" tabindex="-1" aria-labelledby="EditFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditFotoModalLabel">Edit Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kantor.edit-foto',$kantor->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- File Foto Edit -->
                    <div class="form-group">
                        <label>File Foto Edit <span class="text-danger">*</span><br>
                            <sup class="text-danger font-italic">jpg, jpeg, png</sup>
                        </label>
                        <div class="custom-file">
                            <input type="file" name="file_foto_edit" class="custom-file-input @error('file_foto_edit') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label label-file-foto-edit" for="customFile">Choose file</label>
                            @error('file_foto_edit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endpush

@push('js')
<script type="text/javascript">
$('input[name="file_foto_upload"]').change(function(e){
    var fileName = e.target.files[0].name;
    $('.label-file-foto-upload').html(fileName);
});
$('input[name="file_foto_edit"]').change(function(e){
    var fileName = e.target.files[0].name;
    $('.label-file-foto-edit').html(fileName);
});
</script>
@endpush

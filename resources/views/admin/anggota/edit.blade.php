@extends('layouts.admin', ['title' => 'Edit Karyawan','icon' => 'fas fa-users'])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="{{ route('admin.karyawan.update',$karyawan->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ @old('nama_lengkap',$karyawan->nama_lengkap) }}" placeholder="Nama Lengkap..." autofocus>
                        @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>No. Telepone <span class="text-danger">* <sup class="font-italic">Unique</sup></span></label>
                        <input type="number" name="no_telepone" class="form-control @error('no_telepone') is-invalid @enderror" value="{{ @old('no_telepone',$karyawan->no_telepone) }}" placeholder="No. Telepone...">
                        @error('no_telepone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ @old('email',$karyawan->email) }}" placeholder="Email...">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" id="selectRole">
                            <option value="">- pilih -</option>
                            <option value="Staff Lapangan" @if (@old('role',$karyawan->role) == 'Staff Lapangan') selected @endif>Staff Lapangan</option>
                            <option value="Kasie Pembiayaan" @if (@old('role',$karyawan->role) == 'Kasie Pembiayaan') selected @endif>Kasie Pembiayaan</option>
                            <option value="Kasie Keuangan" @if (@old('role',$karyawan->role) == 'Kasie Keuangan') selected @endif>Kasie Keuangan</option>
                            <option value="Admin" @if (@old('role',$karyawan->role) == 'Admin') selected @endif>Admin</option>
                        </select>
                        @error('role')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label><br>
                        <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#ModalEditPassword"><i class="fas fa-lock mr-1"></i> Edit Password</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <select name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="selectTempatLahir">
                                    <option value="">- pilih -</option>
                                    @foreach ($kota as $val_kota)
                                    <option value="{{ $val_kota->id }}" @if (@old('tempat_lahir',$karyawan->kota_id) == $val_kota->id) selected @endif>{{ $val_kota->nama_kota }}</option>
                                    @endforeach
                                </select>
                                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ @old('tanggal_lahir',$karyawan->tanggal_lahir) }}" placeholder="Tanggal Lahir...">
                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status <span class="text-danger">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input name="status" class="form-check-input" type="radio" value="1" id="aktif" @if(@old('status',$karyawan->is_aktif) == 1) checked @endif/>
                            <label class="form-check-label" for="aktif"> Aktif </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="status" class="form-check-input" type="radio" value="0" id="tidakAktif" @if(@old('status',$karyawan->is_aktif) == 0) checked @endif/>
                            <label class="form-check-label" for="tidakAktif"> Tidak Aktif </label>
                        </div>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-md btn-block btn-primary shadow-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.karyawan.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Edit</li>
@endpush

@push('modal')
<!-- Modal Edit Password -->
<div class="modal fade" id="ModalEditPassword" tabindex="-1" aria-labelledby="ModalEditPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEditPasswordLabel">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.karyawan.edit-password',$karyawan->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ @old('password') }}" placeholder="Password...">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" value="{{ @old('konfirmasi_password') }}" placeholder="Konfirmasi Password...">
                        @error('konfirmasi_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-primary">Update</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
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
    $('#selectKantor').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectRole').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
});
</script>
@endpush

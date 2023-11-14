@extends('layouts.admin', ['title' => 'Detail Karyawan','icon' => 'fas fa-users'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-id-card-alt mr-1"></i> No. Induk Karyawan</strong>
                        <p class="text-muted">{{ $karyawan->no_induk_karyawan }}</p>
                        <hr>

                        <strong><i class="fas fa-user mr-1"></i> Nama Lengkap</strong>
                        <p class="text-muted">{{ $karyawan->nama_lengkap }}</p>
                        <hr>

                        <strong><i class="fas fa-user mr-1"></i> Username</strong>
                        <p class="text-muted">{{ $karyawan->username }}</p>
                        <hr>

                        <strong><i class="fas fa-user-tie mr-1"></i> Role</strong>
                        <p class="text-muted">{{ $karyawan->role }}</p>
                        <hr>

                        @if ($karyawan->is_aktif)
                        <strong><i class="fas fa-check mr-1"></i> Status</strong>
                        <p class="text-muted"><span class="badge badge-success ml-2">Aktif</span></p>
                        @else
                        <strong><i class="fas fa-times mr-1"></i> Status</strong>
                        <p class="text-muted"><span class="badge badge-danger ml-2">Tidak Aktif</span></p>
                        @endif
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fas fa-building mr-1"></i> Kantor</strong>
                        <p class="text-muted">{{ $karyawan->kantor->nama_kantor }}</p>
                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat, Tanggal Lahir</strong>
                        <p class="text-muted">{{ $karyawan->tempat_lahir->nama_kota }}, {{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> No. Telepone</strong>
                        <p class="text-muted">{{ $karyawan->no_telepone }}</p>
                        <hr>

                        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $karyawan->email }}</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.karyawan.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Detail</li>
@endpush

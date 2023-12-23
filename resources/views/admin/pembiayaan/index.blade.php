@extends('layouts.admin', ['title' => 'Anggota','icon' => 'fas fa-address-book'])

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.anggota.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus mr-1"></i> Request Pembiayaan</a>
                @if (request('search'))
                <div class="float-right">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-sm btn-warning"><i class="fas fa-sync-alt mr-1"></i> Refresh</a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form action="">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Search..." autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-search mr-1"></i> Search</button>
                                </div>
                              </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tableKaryawan" class="table table-bordered table-hover mb-2">
                        <thead class="bg-secondary">
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>No. Pendaftaran</th>
                                <th>No. Identitas</th>
                                <th>Nama</th>
                                <th>Majlis</th>
                                <th>Status</th>
                                <th>Submit</th>
                                <th>Penginput</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($anggota->count() > 0)
                            @foreach ($anggota as $val)
                                <tr>
                                    {{-- <td>{{ $anggota->count() * ($anggota->currentPage() - 1) + $loop->iteration }}</td> --}}
                                    <td>{{ $val->pendaftaran_anggota->nomor_daftar }}</td>
                                    <td>
                                        @if ($val->jenis_identitas == 'KTP')
                                        {{ $val->no_identitas }} <span class="badge badge-primary">{{ $val->jenis_identitas }}</span>
                                        @else
                                        {{ $val->no_identitas }} <span class="badge badge-secondary">{{ $val->jenis_identitas }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $val->nama_lengkap ?? '' }}</td>
                                    <td>{{ $val->majlis->nama ?? '' }}</td>
                                    <td>
                                        @if ($val->pendaftaran_anggota->status == 'Proses' && $val->pendaftaran_anggota->is_submit == true)
                                        <span class="badge badge-info">{{ $val->pendaftaran_anggota->status }}</span>
                                        @elseif ($val->pendaftaran_anggota->status == 'Survei')
                                        <span class="badge badge-warning">{{ $val->pendaftaran_anggota->status }}</span>
                                        @elseif ($val->pendaftaran_anggota->status == 'Ditolak')
                                        <span class="badge badge-danger">{{ $val->pendaftaran_anggota->status }}</span>
                                        @elseif ($val->pendaftaran_anggota->status == 'Diterima')
                                        <span class="badge badge-success">{{ $val->pendaftaran_anggota->status }}</span>
                                        @else
                                        <span class="badge badge-danger">Unsubmit</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($val->pendaftaran_anggota->is_submit)
                                        <span class="badge badge-success">Submited</span>
                                        @else
                                        <span class="badge badge-danger">Unsubmit</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">{{ $val->pendaftaran_anggota->penginput->role }}</span> {{ $val->pendaftaran_anggota->penginput->nama_lengkap }}
                                    </td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-xs btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item"><i class="fas fa-eye"></i> Detail</a>
                                                @if ($val->id_penginput == Auth::user()->id)
                                                <a href="#" class="dropdown-item"><i class="fas fa-edit"></i> Edit</a>
                                                @endif
                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah yakin ingin menghapus nasabah {{ $val->nama_lengkap }} ?')"><i class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center"><span class="text-muted font-italic">Data tidak ditemukan!</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md">
                        <span class="float-right">{{ $anggota->links() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item active">List Data</li>
@endpush

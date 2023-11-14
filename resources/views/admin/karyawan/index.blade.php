@extends('layouts.admin', ['title' => 'Karyawan','icon' => 'fas fa-users'])

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.karyawan.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus mr-1"></i> Tambah Data</a>
                @if (request('search'))
                <div class="float-right">
                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-warning"><i class="fas fa-sync-alt mr-1"></i> Refresh</a>
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
                                <th>No. Induk</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Tlp</th>
                                <th>Role</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Aktif</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($karyawan->count() > 0)
                            @foreach ($karyawan as $val)
                                <tr>
                                    {{-- <td>{{ $karyawan->count() * ($karyawan->currentPage() - 1) + $loop->iteration }}</td> --}}
                                    <td>{{ $val->no_induk }}</td>
                                    <td>{{ $val->username }}</td>
                                    <td>{{ $val->nama_lengkap }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>{{ $val->no_telepone }}</td>
                                    <td>
                                        @if ($val->role == 'Admin')
                                        <span class="badge badge-secondary">{{ $val->role }}</span>
                                        @elseif ($val->role == 'Kasi Pembiayaan')
                                        <span class="badge badge-warning">{{ $val->role }}</span>
                                        @elseif ($val->role == 'Kasi Keuangan')
                                        <span class="badge badge-success">{{ $val->role }}</span>
                                        @elseif ($val->role == 'Staff Lapangan')
                                        <span class="badge badge-info">{{ $val->role }}</span>
                                        @else
                                        <span class="badge badge-primary">{{ $val->role }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \HelpKaryawan::str_ucfirst($val->tempat_lahir->nama_kota) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($val->tanggal_lahir)->translatedFormat('d-M-Y') }}</td>
                                    <td>
                                        @if ($val->is_aktif)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($val->id != Auth::user()->id)
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-xs btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('admin.karyawan.edit',$val->id) }}" class="dropdown-item"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('admin.karyawan.destroy', $val->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah yakin ingin menghapus : {{ $val->nama_lengkap }} ?')"><i class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center"><span class="text-muted font-italic">Data tidak ditemukan!</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md">
                        <span class="float-right">{{ $karyawan->links() }}</span>
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

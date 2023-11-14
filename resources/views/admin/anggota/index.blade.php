@extends('layouts.admin', ['title' => 'Anggota','icon' => 'fas fa-address-book'])

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#TahapAnggotaModal"><i class="fas fa-plus mr-1"></i> Tambah Data</a>
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
                                    <td>{{ $val->pendaftaran_anggota->no_pendaftaran }}</td>
                                    <td>
                                        @if ($val->jenis_identitas == 'KTP')
                                        {{ $val->no_identitas }} <span class="badge badge-primary ml-1">{{ $val->jenis_identitas }}</span>
                                        @else
                                        {{ $val->no_identitas }} <span class="badge badge-secondary ml-1">{{ $val->jenis_identitas }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $val->nama_lengkap ?? '' }}</td>
                                    <td>{{ $val->majlis->nama ?? '' }}</td>
                                    <td>
                                        @if ($val->pendaftaran_anggota->status_pendaftaran == 'Pending')
                                        <span class="badge badge-info"><i class="fas fa-spinner mr-1"></i> {{ $val->pendaftaran_anggota->status_pendaftaran }}</span>
                                        @elseif ($val->pendaftaran_anggota->status_pendaftaran == 'Survei')
                                        <span class="badge badge-warning"><i class="fas fa-clock mr-1"></i> {{ $val->pendaftaran_anggota->status_pendaftaran }}</span>
                                        @elseif ($val->pendaftaran_anggota->status_pendaftaran == 'Ditolak')
                                        <span class="badge badge-danger"><i class="fas fa-ban mr-1"></i> {{ $val->pendaftaran_anggota->status_pendaftaran }}</span>
                                        @else
                                        <span class="badge badge-success"><i class="fas fa-check-double mr-1"></i> {{ $val->pendaftaran_anggota->status_pendaftaran }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($val->is_submit)
                                        <span class="badge badge-success">Submited</span>
                                        @else
                                        <span class="badge badge-danger">Unsubmit</span>
                                        @endif
                                    </td>
                                    <td>{{ $val->pendaftaran_anggota->penginput->nama_lengkap }}</td>
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

@push('modal')
<!-- Modal Tambah Anggota -->
<div class="modal fade" id="TahapAnggotaModal" tabindex="-1" aria-labelledby="TahapAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TahapAnggotaModalLabel">Tambah Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <!-- Jenis Keanggotaan -->
                    <div class="form-group">
                        <label class="form-label">Jenis Keanggotaan <span class="text-danger">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input name="jenis_keanggotaan" class="form-check-input" type="radio" value="Majlis" id="Majlis" @if(@old('jenis_keanggotaan') == 'Majlis') checked @endif checked>
                            <label class="form-check-label" for="Majlis"> Majlis</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="jenis_keanggotaan" class="form-check-input" type="radio" value="Umum" id="Umum" @if(@old('jenis_keanggotaan') == 'Umum') checked @endif/>
                            <label class="form-check-label" for="Umum"> Umum</label>
                        </div>
                        @error('jenis_keanggotaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <!-- Jenis Identitas -->
                    <div class="form-group">
                        <label class="form-label">Jenis Identitas <span class="text-danger">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input name="jenis_identitas" class="form-check-input" type="radio" value="KTP" id="KTP" @if(@old('jenis_identitas') == 'KTP') checked @endif checked>
                            <label class="form-check-label" for="KTP"> KTP</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="jenis_identitas" class="form-check-input" type="radio" value="SIM" id="SIM" @if(@old('jenis_identitas') == 'SIM') checked @endif/>
                            <label class="form-check-label" for="SIM"> SIM</label>
                        </div>
                        @error('jenis_identitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <!-- No. Identitas -->
                    <div class="form-group">
                        <label>No. Identitas <span class="text-danger">* <sup class="font-italic">KTP/SIM</sup></span></label>
                        <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror" value="{{ @old('no_identitas') }}" placeholder="No. Identitas...">
                        @error('no_identitas')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ @old('nama_lengkap') }}" placeholder="Nama Lengkap..">
                        @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <!-- Majlis -->
                    <div class="form-group">
                        <label>Majlis <span class="text-danger">*</span></label>
                        <select name="majlis" class="form-control @error('majlis') is-invalid @enderror" id="selectMajlis">
                            <option value="">- pilih -</option>
                            @foreach ($majlis as $val_majlis)
                            <option value="{{ $val_majlis->id }}" @if (@old('majlis') == $val_majlis->id) selected @endif>{{ $val_majlis->kode }} | {{ $val_majlis->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush

@push('js')
<script type="text/javascript">
$('#selectMajlis').select2({
    theme: 'bootstrap4',
    // placeholder: '-Pilih-'
})
</script>
@endpush

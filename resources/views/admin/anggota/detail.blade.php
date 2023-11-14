@extends('layouts.admin', ['title' => 'Detail Anggota','icon' => 'fas fa-address-book'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-list-ol mr-1"></i> No. Pendaftaran</strong>
                        <p class="text-muted">{{ $anggota->no_pendaftaran }}</p>
                        <hr>

                        <strong><i class="fas fa-address-card mr-1"></i> No. Identitas</strong>
                        <p class="text-muted">
                            @if ($anggota->jenis_identitas == 'KTP')
                            {{ $anggota->no_identitas }} <span class="badge badge-primary ml-1">{{ $anggota->jenis_identitas }}</span>
                            @else
                            {{ $anggota->no_identitas }} <span class="badge badge-secondary ml-1">{{ $anggota->jenis_identitas }}</span>
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fas fa-user-tie mr-1"></i> Nama Lengkap</strong>
                        <p class="text-muted">{{ $anggota->nama_lengkap }}</p>
                        <hr>

                        <strong><i class="fas fa-user mr-1"></i> Nama Ibu Kandung</strong>
                        <p class="text-muted">{{ $anggota->nama_ibu_kandung }}</p>
                        <hr>

                        <strong><i class="fas fa-house-user mr-1"></i> Majlis</strong>
                        <p class="text-muted">{{ $anggota->majlis->nama_majlis }}</p>
                        <hr>

                        <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>
                        <p class="text-muted">{{ $anggota->jenis_kelamin }}</p>
                        <hr>

                        <strong><i class="fas fa-store mr-1"></i> Jenis Usaha</strong>
                        <p class="text-muted">{{ $anggota->jenis_usaha->nama_usaha }}</p>
                        <hr>

                        <strong><i class="fas fa-info mr-1"></i> Status</strong>
                        @if ($anggota->is_aktif)
                        <p class="text-muted"><span class="badge badge-success"> Aktif</span></p>
                        @else
                        <p class="text-muted"><span class="badge badge-danger"> Tidak Aktif</span></p>
                        @endif
                        <hr>

                        <strong><i class="fas fa-building mr-1"></i> Kantor</strong>
                        <p class="text-muted">
                            @if ($anggota->kantor->is_pusat)
                                KP - {{ $anggota->kantor->nama_kantor }}
                            @else
                                KC - {{ $anggota->kantor->nama_kantor }}
                            @endif
                        </p>
                        <hr>

                        <strong><i class="fas fa-birthday-cake mr-1"></i> Tempat, Tanggal Lahir</strong>
                        <p class="text-muted">{{ $anggota->kota->nama_kota }}, {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                        <hr>

                        <strong><i class="fas fa-graduation-cap mr-1"></i> Pendidikan Terakhir</strong>
                        <p class="text-muted">{{ $anggota->pendidikan_terakhir }}</p>
                        <hr>

                        <strong><i class="fas fa-user-tie mr-1"></i> Penginput</strong>
                        <p class="text-muted">{{ $anggota->penginput->nama_lengkap }}</p>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fas fa-praying-hands mr-1"></i> Agama</strong>
                        <p class="text-muted">{{ $anggota->agama }}</p>
                        <hr>

                        <strong><i class="fas fa-info mr-1"></i> Status Pernikahan</strong>
                        <p class="text-muted">{{ $anggota->status_pernikahan }}</p>
                        <hr>

                        <strong><i class="fas fa-info mr-1"></i> Status Pendaftaran</strong>
                        @if ($anggota->status_pendaftaran == 'Pending')
                        <p class="text-muted"><span class="badge badge-info"><i class="fas fa-spinner mr-1"></i> {{ $anggota->status_pendaftaran }}</span></p>
                        @elseif ($anggota->status_pendaftaran == 'Survei')
                        <p class="text-muted"><span class="badge badge-warning"><i class="fas fa-clock mr-1"></i> {{ $anggota->status_pendaftaran }}</span></p>
                        @elseif ($anggota->status_pendaftaran == 'Ditolak')
                        <p class="text-muted"><span class="badge badge-danger"><i class="fas fa-ban mr-1"></i> {{ $anggota->status_pendaftaran }}</span></p>
                        @else
                        <p class="text-muted"><span class="badge badge-success"><i class="fas fa-check-double mr-1"></i> {{ $anggota->status_pendaftaran }}</span></p>
                        @endif
                        <hr>

                        <strong><i class="fas fa-file-invoice-dollar mr-1"></i> Metode Bayar Pendaftaran</strong>
                        <p class="text-muted">{{ $anggota->metode_bayar_pendaftaran }}</p>
                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> No. Telepone</strong>
                        <p class="text-muted">{{ $anggota->no_telepone }}</p>
                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $anggota->alamat }}</p>
                        <hr>

                        <strong><i class="fas fa-image mr-1"></i> Foto {{ $anggota->jenis_identitas }}</strong>
                        <p class="text-muted"><a href="{{ asset('storage/image/'.$anggota->foto_identitas) }}" target="_blank">{{ $anggota->no_identitas }} <i class="fas fa-eye ml-1"></i></a></p>
                        <hr>

                        <strong><i class="fas fa-image mr-1"></i> Foto KK (Kartu Keluarga)</strong>
                        <p class="text-muted"><a href="{{ asset('storage/image/'.$anggota->foto_kk) }}" target="_blank">Foto KK (Kartu Keluarga) <i class="fas fa-eye ml-1"></i></a></p>
                        <hr>

                        <strong><i class="fas fa-image mr-1"></i> Bukti Bayar Pendaftaran</strong>
                        <p class="text-muted"><a href="{{ asset('storage/image/'.$anggota->foto_kk) }}" target="_blank">{{ $anggota->no_pendaftaran }} <i class="fas fa-eye ml-1"></i></a></p>
                        <hr>

                        <strong><i class="fas fa-image mr-1"></i> Foto Usaha</strong>
                        <p class="text-muted"><a href="{{ asset('storage/image/'.$anggota->foto_usaha) }}" target="_blank">{{ $anggota->jenis_usaha->nama_usaha }} <i class="fas fa-eye ml-1"></i></a></p>
                        <hr>

                        @if ($anggota->catatan_pendaftaran_ditolak->count() > 0)
                        <strong><i class="fas fa-file-alt mr-1"></i> Catatan Ditolak</strong>
                        <p class="text-muted">
                            @foreach ($anggota->catatan_pendaftaran_ditolak as $val_cpd)
                            <i><b>{{ \Carbon\Carbon::parse($val_cpd->tanggal_ditolak)->translatedFormat('d, M Y'); }} :</b><br>
                                {{ $val_cpd->isi_catatan }}
                            </i><br>
                            @endforeach
                        </p>
                        <hr>
                        @endif
                    </div>
                </div>
            </div>
            @if ($anggota->penginput->role != 'Admin' && $anggota->status_pendaftaran == 'Pending' || $anggota->status_pendaftaran == 'Diajukan Ulang')
            <div class="card-footer">
                <form action="{{ route('admin.anggota.approve',$anggota->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah yakin ingin menerima anggota {{ $anggota->nama_lengkap }} ?')">Diterima</button>
                </form>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDitolak">Ditolak</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Detail</li>
@endpush

@if ($anggota->penginput->role != 'Admin' && $anggota->status_pendaftaran == 'Pending' || $anggota->status_pendaftaran == 'Diajukan Ulang')
@push('modal')
<!-- Modal Mendefisinikan Kantor -->
<div class="modal fade" id="ModalDitolak" tabindex="-1" aria-labelledby="ModalDitolakLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalDitolakLabel">Catatan Ditolak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.anggota.reject',$anggota->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Isi Catatan <span class="text-danger">*</span></label>
                        <textarea name="isi_catatan" class="form-control @error('isi_catatan') is-invalid @enderror" cols="5" rows="5" placeholder="Catatan Ditolak...">{{ @old('isi_catatan') }}</textarea>
                        @error('isi_catatan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary shadow-sm">Lanjtkan</button>
                    <button type="button" class="btn btn-sm btn-secondary shadow-sm" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush
@endif

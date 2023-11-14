@extends('layouts.admin', ['title' => 'Tambah Majlis','icon' => 'fas fa-house-user'])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <a href="{{ route('admin.majlis.index') }}" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg">
                <form action="{{ route('admin.majlis.update',$majlis->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Kode  -->
                            <div class="form-group">
                                <label>Kode <span class="text-danger">* <sup class="font-italic">3 angka</sup></span></label>
                                <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ @old('kode',$majlis->kode) }}" placeholder="Contoh : 001" autofocus>
                                @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ @old('nama',$majlis->nama) }}" placeholder="Nama...">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kategori -->
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                    <option value="">- pilih -</option>
                                    <option value="MMU" @if(@old('kategori',$majlis->kategori) == 'MMU') selected @endif>MMU (Muharabahah)</option>
                                    <option value="MMG" @if(@old('kategori',$majlis->kategori) == 'MMG') selected @endif>MMG (Murabahah)</option>
                                </select>
                                @error('petugas')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label>Kecamatan <span class="text-danger">*</span></label>
                                <select name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" id="selectKecamatan">
                                    <option value="">- pilih -</option>
                                    @foreach ($kecamatan as $val_kec)
                                    <option value="{{ $val_kec->id }}" @if(@old('kecamatan',$majlis->kecamatan_id) == $val_kec->id) selected @endif>{{ $val_kec->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Desa/Kelurahan -->
                            <div class="form-group">
                                <label>Kelurahan <span class="text-danger">*</span></label>
                                <select name="kelurahan" class="form-control" id="selectKelurahan" disabled></select>
                                @error('kelurahan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Alamat -->
                            <div class="form-group">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ @old('alamat',$majlis->alamat) }}" placeholder="Alamat...">
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- RT/RW -->
                            <div class="form-group">
                                <label>RT/RW <span class="text-danger">*</span></label>
                                <input type="text" name="rt_rw" class="form-control @error('rt_rw') is-invalid @enderror" value="{{ @old('rt_rw',$majlis->rt_rw) }}" placeholder="RT/RW...">
                                @error('rt_rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Petugas -->
                            <div class="form-group">
                                <label>Petugas <span class="text-danger">*</span></label>
                                <select name="petugas" class="form-control @error('petugas') is-invalid @enderror" id="selectPetugas">
                                    <option value="">- pilih -</option>
                                    @foreach ($petugas as $val_petugas)
                                    <option value="{{ $val_petugas->id }}" @if(@old('petugas',$majlis->petugas_id) == $val_petugas->id) selected @endif>{{ $val_petugas->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('petugas')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Tanggal Berdiri -->
                            <div class="form-group">
                                <label>Tanggal Berdiri <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_berdiri" class="form-control @error('tanggal_berdiri') is-invalid @enderror" value="{{ @old('tanggal_berdiri',$majlis->tanggal_berdiri) }}">
                                @error('tanggal_berdiri')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-md btn-block btn-primary shadow-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.majlis.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endpush

@push('js')
<script type="text/javascript">
$(document).ready(function (e) {
    $('#selectPetugas').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectKecamatan').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectKelurahan').select2({
        theme: 'bootstrap4',
        // placeholder: '-Pilih-'
    })
    $('#selectKecamatan').on('change', function() {
        var kecID = $(this).val();
        if(kecID) {
            $.ajax({
                url: '/get-kelurahan/'+kecID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data){
                    if(data){
                        $('#selectKelurahan').empty();
                        $('#selectKelurahan').append('<option hidden>- Pilih -</option>');
                        $('#selectKelurahan').removeAttr("disabled");
                        $.each(data, function(key, kel){
                            $('select[name="kelurahan"]').append('<option value="'+ kel.id +'">' + kel.nama_kelurahan+ '</option>');
                        });
                    }else{
                        $('#selectKelurahan').empty();
                    }
                }
            });
        }else{
            $('#selectKelurahan').empty();
            $('#selectKelurahan').setAttr("disabled");
        }
    });
});
</script>
@endpush

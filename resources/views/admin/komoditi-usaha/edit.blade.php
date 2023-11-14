@extends('layouts.admin', ['title' => 'Edit Komoditi Usaha','icon' => 'fas fa-store'])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <a href="{{ route('admin.komoditi-usaha.index') }}" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg">
                <form action="{{ route('admin.komoditi-usaha.update',$komoditi->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Jenis Usaha -->
                            <div class="form-group">
                                <label>Jenis Usaha <span class="text-danger">*</span></label>
                                <select name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror" id="selectJenisUsaha">
                                    <option value="">- pilih -</option>
                                    @foreach ($jenis_usaha as $val_ju)
                                    <option value="{{ $val_ju->id }}" @if(@old('jenis_usaha',$komoditi->jenis_usaha->id) == $val_ju->id) selected @endif>{{ $val_ju->kode }} | {{ $val_ju->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_usaha')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Komoditi -->
                            <div class="form-group">
                                <label>Komoditi <span class="text-danger">*</span></label>
                                <input type="text" name="komoditi" class="form-control @error('komoditi') is-invalid @enderror" value="{{ @old('komoditi',$komoditi->nama) }}" placeholder="Komoditi...">
                                @error('komoditi')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-md btn-block btn-primary shadow-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.komoditi-usaha.index') }}">List Data</a></li>
<li class="breadcrumb-item active">Edit</li>
@endpush

@push('js')
<script type="text/javascript">
$('#selectJenisUsaha').select2({
    theme: 'bootstrap4',
    // placeholder: '-Pilih-'
});
</script>
@endpush

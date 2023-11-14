@extends('layouts.admin', ['title' => 'Edit Kantor','icon' => 'fas fa-building'])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <a href="{{ route('admin.kantor.index') }}" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="{{ route('admin.kantor.update',$kantor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Kode Kantor</label>
                        <input type="text" class="form-control" value="{{ $kantor->kode }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Kantor</label>
                        <input type="text" class="form-control" value="{{ $kantor->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">* <sup class="font-italic">Unique</sup></span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ @old('email',$kantor->email) }}" placeholder="Email...">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>No. Telepone <span class="text-danger">* <sup class="font-italic">Unique</sup></span></label>
                        <input type="number" name="no_telepone" class="form-control @error('no_telepone') is-invalid @enderror" value="{{ @old('no_telepone',$kantor->no_telepone) }}" placeholder="No. Telepone...">
                        @error('no_telepone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="5" rows="5" placeholder="Alamat...">{{ @old('alamat',$kantor->alamat) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control" value="{{ $kantor->provinsi->nama_provinsi }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kota/Kabupaten</label>
                        <input type="text" class="form-control" value="{{ $kantor->kota_kab->nama_kota }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan <span class="text-danger">*</span></label>
                        <select name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" id="selectKecamatan">
                            <option value="">- pilih -</option>
                            @foreach ($kecamatan as $val_kec)
                            <option value="{{ $val_kec->id }}" @if (@old('kecamatan',$kantor->kecamatan_id) == $val_kec->id) selected @endif>{{ $val_kec->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kelurahan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Desa/Kelurahan <span class="text-danger">*</span></label>
                        <select name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror" id="selectKelurahan" disabled>
                            <option value="">- pilih -</option>
                        </select>
                        @error('kelurahan')<div class="invalid-feedback">{{ $message }}</span></div>@enderror
                    </div>
                    <div class="form-group">
                        <label>RT/RW <span class="text-danger">*</span></label>
                        <input type="text" name="rt_rw" class="form-control @error('rt_rw') is-invalid @enderror" value="{{ @old('rt_rw',$kantor->rt_rw) }}" placeholder="RT/RW...">
                        @error('rt_rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-block btn-primary shadow-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.kantor.index') }}">Index</a></li>
<li class="breadcrumb-item active">Edit</li>
@endpush

@push('js')
<script type="text/javascript">
$('#selectKelurahan').select2({
    theme: 'bootstrap4',
    // placeholder: '-Pilih-'
})
$('#selectKecamatan').select2({
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
                    $('#selectKelurahan').removeAttr("disabled");
                    $.each(data, function(key, Kec){
                        $('select[name="kelurahan"]').append('<option value="'+ Kec.id +'">' + Kec.nama_kelurahan+ '</option>');
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
</script>
@endpush

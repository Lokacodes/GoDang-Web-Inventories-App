@extends('index')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Barang</h4>
                <form class="forms-sample" action="/barang/update/{kode_barang}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" readonly class="form-control form-control-user" id="kode_barang"
                            name="kode_barang" value="{{ $det->kode_barang }}" placeholder="Kode Barang">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control form-control-user" id="nama_barang" name="nama_barang"
                            value="{{ $det->nama_barang }}" placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori">kategori barang</label>
                        <select class="form-control" name="kode_kategori" id="kode_kategori"
                            value="{{ $det->kode_kategori }}">
                            <option selected="{{ $det->kode_kategori }}">{{ $det->kode_kategori }}</option>
                            @foreach ($kat as $k)
                                <option value="{{ $k->kode_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select class="form-control" name="kode_brand" id="kode_brand" value="{{ $det->kode_brand }}">
                            <option selected="{{ $det->kode_brand }}">{{ $det->kode_brand }}</option>
                            @foreach ($brand as $b)
                                <option value="{{ $b->kode_brand }}">{{ $b->nama_brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="text" class="form-control form-control-user" id="harga_beli" name="harga_beli"
                            value="{{ $det->harga_beli }}" placeholder="Harga Beli">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga jual</label>
                        <input type="text" class="form-control form-control-user" id="harga_jual" name="harga_jual"
                            value="{{ $det->harga_jual }}" placeholder="Harga Jual">
                    </div>
                    <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input type="text" class="form-control form-control-user" id="stok_barang" name="stok_barang"
                            value="{{ $det->stok_barang }}" placeholder="Stok Barang">
                    </div>
                    {{-- <div class="form-group">
                        <label for="foto">Foto Barang</label>
                        <input type="file" class="file-upload-default" id="foto" name="foto"
                            value="{{ $det->foto }}" accept="images/">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control form-control-user" id="foto" name="foto"
                             accept="image/*" placeholder="Foto IoT">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection

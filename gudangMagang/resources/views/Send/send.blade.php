@extends('index')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sending</h4>
                    <div class="form-group">
                        <label for="nama_barang">Select Nama Barang</label>
                        <select class="js-example-basic-single w-100" name="barang" id="nama_barang">
                            <option selected value="-">-</option>
                            @foreach ($send as $s)
                                <option value="{{ $s->kode_barang }}">{{ $s->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="card-description">
                        Detail Informasi Barang
                    </p>
                    <div class="form-group row">
                        <div class="col">
                            <label>Stok</label>
                            <div id="the-basics">
                                <input class="typeahead" type="text" placeholder="Brand" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <label>Harga</label>
                            <div id="bloodhound">
                                <input class="typeahead" type="text" placeholder="Stok" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" />
                        </div>
                    </div>
                    <a class="d-md-flex justify-content-md-end">
                        <button type="button" id="modal" class="btn btn-primary">Tambah Keranjang</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('index')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TRANSAKSI</h4>
                    <div class="form-group">
                        <label>Select Nama Barang</label>
                        <select class="js-example-basic-single w-100">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                            <option value="AM">America</option>
                            <option value="CA">Canada</option>
                            <option value="RU">Russia</option>
                            <option value="IO">XAM</option>
                        </select>
                    </div>
                    <p class="card-description">
                        Detail Informasi Barang
                    </p>
                    <div class="form-group row">
                        <div class="col">
                            <label>Brand</label>
                            <div id="the-basics">
                                <input class="typeahead" type="text" placeholder="Brand" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <label>Stok</label>
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

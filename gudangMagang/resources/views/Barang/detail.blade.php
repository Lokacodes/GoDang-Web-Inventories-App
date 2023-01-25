@extends('index')

@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title"></p>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Kode Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->kode_barang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Nama Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->nama_barang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Kategori Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->nama_kategori }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Brand</label>:
                                    <div class="col-sm-8">
                                        {{ $det->nama_brand }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Harga Jual</label>:
                                    <div class="col-sm-8">
                                        {{ $det->harga_jual }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Stok Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->stok_barang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Berat Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->berat_barang}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Supplier</label>:
                                    <div class="col-sm-8">
                                        {{ $det->kode_supplier }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-4 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Gambar</p>
                    <label class="col-sm-12">COMING SOON</label>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="col-lg-12 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="/barang/edit/{{ $det->kode_barang }}">
            <button type="button" class="btn btn-primary">EDIT</button>
        </a>
    </div>
    
@endsection

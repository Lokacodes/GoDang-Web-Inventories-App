@extends('index')
@section('content')
    <form class="user" action="">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Receiving</h4>
                        <div class="form-group">
                            <label for="caribarang">Input Nama Barang</label>
                            <input type="text" class="form-control form-control-user" id="caribarang" name="caribarang"
                                placeholder="Masukkan Nama Barang" aria-label="Search" aria-describedby="basic-addon2">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        </div>
                        <div class="form-group">
                            <label for="caribarang">Daftar Nama Barang</label>
                            <select class="js-example-basic-single w-100" name="caribarang" id="caribarang"
                                aria-label="Search" aria-describedby="basic-addon2">
                                <option selected value="-">-</option>
                                @foreach ($receive as $r)
                                    <option value="{{ $r->kode_barang }}">{{ $r->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card" id="detail">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Informasi Barang</h4>
                        <div class="form-group row">
                            <div class="col">
                                <label>Brand</label>
                                <div class="form-group">
                                    <input class="typeahead" type="text" id="nama_brand" name="nama_brand"
                                        placeholder="Brand" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <label>Stok</label>
                                <div class="form-group">
                                    <input class="typeahead" type="text" placeholder="Stok Belum Terisi" id="stok_barang"
                                        name="stok_barang" disabled>
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
                            <button type="button" id="tambah_gudang" class="btn btn-primary">Tambah Ke Gudang</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body" id="tabelGudang" name="tabelGundang">
                <h4 class="card-title">Barang List</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Brand Barang</th>
                                <th>Stok Barang</th>
                            </tr>
                        </thead>
                        <tbody id="template">

                        </tbody>
                    </table><br>
                    <a class="d-md-flex justify-content-md-end">
                        <button type="button" id="tambah_gudang" class="btn btn-primary">Konfirmasi</button>
                    </a>
                </div>
            </div>
        </div>
    </form>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                let detail = document.getElementById('detail');
                detail.style.visibility = 'hidden';
                //alert("ready");
                $("#caribarang").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/receiving/search",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                search: request.term
                            },
                            success: function(data) {
                                response(data);

                            }
                        });
                    },
                    select: function(event, ui) { // Set selection
                        $('#caribarang').val(ui.item.value);
                        $('#nama_brand').val(ui.item.brand); // display the selected text
                        $('#stok_barang').val(ui.item.stok); // save selected id to input
                        detail.style.visibility = 'visible';

                        return false;
                    }
                });
            });
        </script>
    @endpush
@endsection

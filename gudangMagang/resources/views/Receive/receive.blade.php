@extends('index')
@section('content')
    <form class="user" action="/receiving/gudang">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Receiving</h4>
                        <div class="form-group">
                            <label for="carisuppli">Input Kode Supplier</label>
                            <input type="text" class="form-control form-control-user" id="carisuppli" name="carisuppli"
                                placeholder="Masukkan Nama Supplier" aria-label="Search" aria-describedby="basic-addon2">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        </div>
                        <div class="form-group">
                            <label for="carisuppli">Daftar Nama Supplier</label>
                            <select class="js-example-basic-single w-100" name="carisuppli" id="carisuppli"
                                aria-label="Search" aria-describedby="basic-addon2">
                                <option selected value="-">-</option>
                                @foreach ($receive as $r)
                                    <option value="{{ $r->kode_supplier }}">{{ $r->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Informasi Supplier</h4>
                        <div class="form-group row">
                            <div class="col">
                                <label>Nama Supplier</label>
                                <div class="form-group">
                                    <input class="typeahead" type="text" id="nama_supplier" name="nama_supplier"
                                        placeholder="Nama Supplier" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <label>Alamat Supplier</label>
                                <div class="form-group">
                                    <input class="typeahead" type="text" id="alamat" name="alamat"
                                        placeholder="Alamat Supplier" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin " id="barang">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Masukkan Data Barang</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-user" id="caribarang"
                                            name="caribarang" placeholder="Masukkan Nama Barang" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                            value="" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga Jual</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="harga_jual" id="harga_jual"
                                            value="" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stok Barang</label>
                                    <div class="col-sm-9">
                                        <input type="int" class="form-control" name="stok_barang" id="stok_barang"
                                            value="" readonly   />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="supplier" id="supplier"
                                            value="" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Terima</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal"
                                            value="{{ date('Y-m-d') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah Barang</label>
                                    <div class="col-sm-9">
                                        <input type="int" class="form-control" name="jumlah" id="jumlah"
                                            value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="keranjang">Tambah Keranjang</button>
                        </div><br>
                        <table id="keranjang" name="keranjang" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Ditambah</th>
                                    <th>Total Di Gudang</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="template">

                            </tbody>
                        </table><br>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-info">
                                Masukkan Gudang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                //Input Barang Receive
                let barang = document.getElementById('barang');
                barang.style.visibility = 'hidden';

                //Card Detail Supplier
                $("#carisuppli").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/receiving/supply",
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
                    select: function(event, ui) {
                        $('#carisuppli').val(ui.item.value);
                        $('#nama_supplier').val(ui.item.nama);
                        $('#alamat').val(ui.item.alamat);
                        barang.style.visibility = 'visible';

                        return false;
                    }
                });

                //Card Input 
                $("#caribarang").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/receiving/barang",
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
                    select: function(event, ui) {
                        // Set selection
                        $('#caribarang').val(ui.item.value);
                        $('#kode_barang').val(ui.item.label1);
                        $('#stok_barang').val(ui.item.label2);
                        $('#supplier').val(ui.item.label3);
                        $('#harga_jual').val(ui.item.label4);
                        return false;
                    }
                });
                var row = 1;
                $('#keranjang').click(function() {

                    let barang = $("#caribarang").val();
                    let kode_barang = $("#kode_barang").val();
                    let jumlah = $("#jumlah").val();
                    let total = parseInt($("#stok_barang").val()) + parseInt($("#jumlah").val());

                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="nomor[]" value="' +
                        row +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name=kode_barang[]" value="' +
                        kode_barang +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="nama_barang[]" value="' +
                        barang +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="jumlah[]" value="' +
                        jumlah +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="total[]" value="' +
                        total +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="status[]" value="1" readonly></td></tr>'

                    );
                    row++;
                    document.getElementById("caribarang").value = "";
                    document.getElementById("kode_barang").value = "";
                    document.getElementById("jumlah").value = "";
                    document.getElementById("total").value = "";
                });
            });
        </script>
    @endpush
@endsection

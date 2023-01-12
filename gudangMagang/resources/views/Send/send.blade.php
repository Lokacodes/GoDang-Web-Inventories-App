@extends('index')
@section('content')
<form action="/sending/save" >
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sending</h4>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="caribarang">Input Nama Barang</label>
                            <input type="text" class="form-control form-control-user" id="caribarang" name="caribarang"
                                placeholder="Masukkan Nama Barang" aria-label="Search" aria-describedby="basic-addon2">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        </div>
                        {{-- <label for="caribarang">Select Nama Barang</label>
                        <select class="js-example-basic-single w-100" name="caribarang" id="caribarang">
                            <option selected value="-">-</option>
                            @foreach ($send as $s)
                                <option value="{{ $s->kode_barang }}">{{ $s->nama_barang }}</option>
                            @endforeach
                        </select> --}}
                    </div>
                    <p class="card-description">
                        Detail Informasi Barang
                    </p>
                    <div class="form-group row">
                        <div class="col">
                            <label>Stok</label>
                            <div id="the-basics">
                                <input class="typeahead" type="text" placeholder="Stok" id="stok_barang" name="stok_barang" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <label>Harga</label>
                            <div id="bloodhound">
                                <input class="typeahead" type="text" placeholder="Harga" id="harga_jual" name="harga_jual" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Kode Barang</label>
                            <div id="the-basics">
                                <input class="typeahead" type="text" placeholder="Kode Barang" id="kode_barang" name="kode_barang" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input id="jumlah" name="jumlah" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary" id="tambah_keranjang">Tambah Keranjang</button>
                    </div><br>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Informasi Ekspedisi</h4>
                    <div class="form-group row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cari_kurir">Input Nama Ekspedisi</label>
                                <input type="text" class="form-control form-control-user" id="cari_kurir" name="cari_kurir"
                                    placeholder="Masukkan Nama Ekspedisi" aria-label="Search" aria-describedby="basic-addon2">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>
                        <div class="col">
                            <label>Ongkos Kirim</label>
                            <div class="form-group">
                                <input class="typeahead" type="text" id="ongkir" name="ongkir"
                                    placeholder="Ongkos Kirim" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card" id="keranjang_card">
            <div class="card">
                <div class="card-body">
                    <table id="keranjang" name="keranjang" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Dibeli</th>
                                <th>Sub Total</th>
                                <th>Ongkos Kirim</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="template">
            
                        </tbody>
                    </table>
                    <div class="card-body">
                        <button type="submit" class="btn btn-info">
                            Save
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
                let keranjang = document.getElementById('keranjang_card');
                keranjang.style.visibility = 'hidden';

                //Card Detail Supplier
                // $("#caribarang").autocomplete({
                //     source: function(request, response) {
                //         // Fetch data
                //         $.ajax({
                //             url: "/sending/barang",
                //             type: 'post',
                //             dataType: "json",
                //             data: {
                //                 _token: $("#csrf").val(),
                //                 search: request.term
                //             },
                //             success: function(data) {
                //                 response(data);

                //             }
                //         });
                //     },
                //     select: function(event, ui) {
                //         $('#caribarang').val(ui.item.value);
                //         $('#stok_barang').val(ui.item.stok);
                //         $('#harga_jual').val(ui.item.harga);
                //         barang.style.visibility = 'visible';

                //         return false;
                //     }
                // });
                $("#cari_kurir").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/sending/kurir",
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
                        $('#cari_kurir').val(ui.item.value);
                        $('#ongkir').val(ui.item.ongkir);
                        keranjang.style.visibility = 'visible';
                        return false;
                    }
                });

                //Card Input 
                $("#caribarang").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/sending/barang",
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
                        $('#harga_jual').val(ui.item.label4);
                        return false;
                    }
                });

                var row = 1;
                $('#tambah_keranjang').click(function() {

                    let barang = $("#caribarang").val();
                    let kode_barang = $("#kode_barang").val();
                    let jumlah = $("#jumlah").val();
                    let harga = $("#harga_jual").val();
                    let kurir = $("#cari_kurir").val();
                    let subtotal = parseInt($("#harga_jual").val()) * parseInt($("#jumlah").val());
                    let ongkir = $("#ongkir").val();
                    let total = parseInt(subtotal) + parseInt(ongkir);

                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="nomor[]" value="' +
                        row +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="kode_barang[]" value="' +
                        kode_barang +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="nama_barang[]" value="' +
                        barang +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="jumlah_dibeli[]" value="' +
                        jumlah +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="subtotal[]" value="' +
                        subtotal +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="ongkir[]" value="' +
                        ongkir +
                        '" readonly></td><td><input type="text" class="form-control form-control-user" name="total[]" value="' +
                        total +
                        '" readonly></td></tr>'

                    );
                    row++;
                    document.getElementById("caribarang").value = "";
                    document.getElementById("kode_barang").value = "";
                    document.getElementById("harga_jual").value = "";
                    document.getElementById("stok").value = "";
                    // document.getElementById("total").value = "";
                });
            });
        </script>
    @endpush
@endsection

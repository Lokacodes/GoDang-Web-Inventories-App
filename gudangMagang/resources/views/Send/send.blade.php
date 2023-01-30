@extends('index')
@section('content')
    <form action="/sending/save">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">SENDING</h4>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-6">
                                    <label>Kode Sending</label>

                                    <input type="text" class="form-control" name="kode_sending" id="kode_sending"
                                        value="{{ 'OUT-' . date('dmy') . '-' . $kd }}" placeholder="Kode Sending"
                                        readonly />
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal</label>

                                    <input type="text" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ date('d-m-y') }}" placeholder="Tanggal" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div style="display:none;" class="col-md-6">
                                    <label>Kode Sending</label>

                                    <input type="text" class="form-control" name="kode_send" id="kode_send"
                                        value="{{ 'OUT-' . date('dmy') . '-' . $kd }}" placeholder="Kode Sending"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="card-description">
                            Detail Informasi Barang
                        </p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="caribarang">Input Nama Barang</label>
                                        <input type="text" class="form-control form-control-user" id="caribarang"
                                            name="caribarang" placeholder="Masukkan Nama Barang" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode Barang</label>
                                        <input class="typeahead" type="text" placeholder="Kode Barang" id="kode_barang"
                                            name="kode_barang" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Stok</label>
                                <div>
                                    <input class="typeahead" type="text" placeholder="Stok" id="stok_barang"
                                        name="stok_barang" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Harga</label>
                                <div>
                                    <input class="typeahead" type="text" placeholder="Harga" id="harga_jual"
                                        name="harga_jual" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Berat</label>
                                <div>
                                    <input class="typeahead" type="text" placeholder="Berat Barang" id="berat_barang"
                                        name="berat_barang" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Jumlah Beli</label>
                                <input id="jumlah" name="jumlah" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="tambah_keranjang" name="tambah">Tambah
                                Keranjang</button>
                        </div><br>
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
                                    <th width="250px">Kode Sending</th>
                                    <th width="250px">Nama Barang</th>
                                    <th id="berat_brg">Berat Barang</th>
                                    <th>Jumlah Dibeli</th>
                                    <th width="250px">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="template">
                            </tbody>
                            <tfoot id="footerTemplate">
                                <tr>
                                    <th class="text-center bg_total" colspan="2"><b>TOTAL</b></th>
                                    <th><input class="form-control form-control-user" readonly type="text"
                                            name="total_berat" id="total_berat" value=""></th>
                                    <th><input class="form-control form-control-user" readonly type="text"
                                            name="total_beli" id="total_beli" value=""></th>
                                    <th><input class="form-control form-control-user" readonly type="text"
                                            name="total_harga" id="total_harga" value=""></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div id="info_pengiriman" class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Informasi Ekspedisi</h4>

                    <div class="form-group">
                        <label for="nama_pel">Nama Pelanggan</label>
                        <input type="text" class="form-control form-control-user" id="nama_pel" name="nama_pel"
                            placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="alamat_pel">Alamat Pelanggan</label>
                        <input type="textarea" class="form-control" id="alamat_pel" name="alamat_pel"
                            placeholder="Alamat Pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="textarea" class="form-control" id="no_telp" name="no_telp"
                            placeholder="Nomor Telepon">
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <input type="textarea" class="form-control form-control-user" id="catatan" name="catatan"
                            placeholder="Catatan">
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cari_kurir">Input Nama Ekspedisi</label>
                                <input type="text" class="form-control form-control-user" id="cari_kurir"
                                    name="cari_kurir" placeholder="Masukkan Nama Ekspedisi" aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>
                        <div class="col">
                            <label>Ongkos Kirim</label>
                            <div class="form-group">
                                <input class="typeahead" type="text" id="ongkir" name="ongkir"
                                    placeholder="Ongkos Kirim">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <button id="save_bt" type="submit" class="btn btn-info">
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
                let pengiriman = document.getElementById('info_pengiriman');
                keranjang.style.visibility = 'hidden';
                pengiriman.style.visibility = 'hidden';

                var render = createwidgetlokasi("provinsi", "kotaKab", "kecamatan", "kelurahan");



                $("#show").click(function() {
                    $("#output").html(trackdatalokasi);
                });

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
                        $('#cari_kurir').val(ui.item.kode);
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
                        $('#harga_jual').val(ui.item.label4);
                        $('#berat_barang').val(ui.item.berat);

                        if (ui.item.label2 <= 0) {
                            $('#stok_barang').val("Stok Habis!");
                            document.getElementById("tambah_keranjang").disabled = true;
                            alert('Stok habis!');
                        } else {
                            $('#stok_barang').val(ui.item.label2);
                        }

                        return false;
                    }
                });

                var row = 1;
                let sumberat = 0;
                let sumbeli = 0;
                let sumharga = 0;
                $('#tambah_keranjang').click(function() {
                    keranjang.style.visibility = 'visible';
                    pengiriman.style.visibility = 'visible';
                    let kode_sending = $("#kode_sending").val();
                    let barang = $("#caribarang").val();
                    let kode_barang = $("#kode_barang").val();
                    let jumlah = $("#jumlah").val();
                    let harga = $("#harga_jual").val();
                    let kurir = $("#cari_kurir").val();
                    let subtotal = parseInt($("#harga_jual").val()) * parseInt($("#jumlah").val());
                    let ongkir = $("#ongkir").val();
                    let total = parseInt(subtotal) + parseInt(ongkir);
                    let berat = $("#berat_barang").val();
                    let sending_kode = $("#kode_sending").val();
                    let sisa = $("#stok_barang").val() - $("#jumlah").val();

                    let new_row = row - 1;
                    $('#template').append(
                        '<tr><td><input type="text" class="form-control form-control-user"name="kode_sending[]" value="' +
                        kode_sending +
                        '"readonly></td><td style="display:none;"><input type="text" class="form-control form-control-user" name="kode_barang[]" value="' +
                        kode_barang +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="nama_barang[]" value="' +
                        barang +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="berat_barang[]" value="' +
                        berat +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="jumlah_dibeli[]" value="' +
                        jumlah +
                        '"readonly></td><td style="display: none;"><input type="text" class="form-control form-control-user" name="sisa[]" value="' +
                        sisa +
                        '"readonly></td><td><input type="text" class="form-control form-control-user" name="subtotal[]" value="' +
                        subtotal +
                        '" ></td></tr>'
                    );
                    totalberat();
                    totalbeli();
                    totalharga();
                    row++;

                    function totalberat() {
                        $("#berat_barang").each(function() {

                            let totalValue = $(this).val();
                            let jumlah_this = $("#jumlah").val();


                            if (!isNaN(totalValue) && totalValue.length != 0) {
                                sumberat += (parseFloat(totalValue) * parseFloat(jumlah_this));
                            }
                            // console.log(sumberat);
                        })
                        $('#total_berat').val(sumberat);
                    }

                    function totalbeli() {
                        $("#jumlah").each(function() {


                            let totalValue = $(this).val();


                            if (!isNaN(totalValue) && totalValue.length != 0) {
                                sumbeli += parseFloat(totalValue);
                            }
                            // console.log(sumbeli);
                        })
                        $('#total_beli').val(sumbeli);
                    }

                    function totalharga() {
                        $("#harga_jual").each(function() {

                            let totalValue = $(this).val();
                            let jumlah_this = $("#jumlah").val();


                            if (!isNaN(totalValue) && totalValue.length != 0) {
                                sumharga += (parseFloat(totalValue) * parseFloat(jumlah_this));
                            }
                            // console.log(sumharga);
                            // console.log(jumlah_this);
                        })
                        $('#total_harga').val(sumharga);
                    }
                    document.getElementById("caribarang").value = "";
                    document.getElementById("kode_barang").value = "";
                    document.getElementById("harga_jual").value = "";
                    document.getElementById("berat_barang").value = "";
                    document.getElementById("jumlah").value = "";
                    document.getElementById("stok_barang").value = "";
                });
            });
        </script>

        <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>
    @endpush
@endsection

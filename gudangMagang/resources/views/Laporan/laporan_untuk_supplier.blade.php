@extends('index')

@section('content')
    <div class="row justify-content-center">
        <div id="print_out" class="col-md-6 stretch-card grid-margin ">
            <div class="card ">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6   ">
                            <div class="form-group">
                                <label for="carisupplier">Input Nama Supplier</label>
                                <input type="text" class="form-control form-control-user" id="carisupplier"
                                    name="carisupplier" placeholder="Masukkan Nama Supplier" aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_supplier">Kode Supplier</label>
                                <input readonly type="text" class="form-control form-control-user" id="kode_supplier"
                                    name="kode_supplier" placeholder="Kode Supplier">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-primary" id="tampilkan">Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card col-md-12" id="barang_list" name="barang_list">
            <div class="card-body">
                <table id="empTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50px">
                                <center>NO</center>
                            </th>
                            <th>
                                <center>Kode Barang</center>
                            </th>
                            <th>
                                <center>Nama Barang</center>
                            </th>
                            <th>
                                <center>Stok</center>
                            </th>
                            <th>
                                <center>Harga</center>
                            </th>
                            <th>
                                <center>Jumlah Terbeli</center>
                            </th>
                            <th>
                                <center>Fee</center>
                            </th>
                            <th>
                                <center>Penghasilan</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                let tabel = document.getElementById('barang_list');
                tabel.style.visibility = 'hidden';

                $("#carisupplier").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/lapSupplier/supplier",
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
                        $('#carisupplier').val(ui.item.value);
                        $('#kode_supplier').val(ui.item.kode);
                        return false;
                    }
                });

                $("#tampilkan").click(function() {

                    tabel.style.visibility = 'visible';
                    let kode_supp = $("#kode_supplier").val();
                    tampilBarang(kode_supp);
                });

                function tampilBarang(kode_supplier) {
                    $('tbody').html("");
                    $.ajax({
                        url: "/lapSupplier/" + kode_supplier,
                        type: 'get',
                        dataType: "json",
                        success: function(data) {
                            let no = 1;
                            $.each(data, function(key, values) {
                                kode_barang = data[key].kode_barang;
                                nama_barang = data[key].nama_barang;
                                stok_barang = data[key].stok_barang;
                                harga_jual = data[key].harga_jual;
                                jumlah_barang = data[key].jumlah_barang;
                                // fee = 0.25;
                                // keuntungan = nanti isi keuntungan;
                                $('tbody').append(
                                    '<tr>\
                                        <td>' + parseInt(key + 1) + '</td>\
                                        <td>' + kode_barang + '</td>\
                                        <td>' + nama_barang + '</td>\
                                        <td>' + stok_barang + '</td>\
                                        <td>' + harga_jual + '</td>\
                                        <td>' + jumlah_barang + '</td>\
                                        <td>2,5%</td>\
                                        <td>' + (parseInt(harga_jual) - (parseInt(harga_jual) *  0.025)) * jumlah_barang + '</td>\
                                    </tr>'
                                );
                            })
                            response(data);
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection

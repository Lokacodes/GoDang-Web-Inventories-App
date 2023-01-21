@extends('index')

@section('content')
    <div class="row justify-content-center">
        {{-- <div class="col-md-6 stretch-card grid-margin ">
            <div class="card ">
                <div class="card-body">
                </div>
            </div>
        </div> --}}
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
                                <input type="hidden" name="_token2" id="csrf2" value="{{ Session::token() }}">
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
                                <center>Keuntungan</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $no = 1;
                        @endphp
                        @foreach ($barangSupp as $b)

                        <tr>
                            <td> {{$no++}} </td>
                            <td> {{$b->kode_barang}} </td>
                        </tr>
                            
                        @endforeach --}}

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
                        // $('#kode_suppliers').val(ui.item.kode);
                        // $('#alamat').val(ui.item.alamat);
                        return false;
                    }
                });

                $('#tampilkan').click(function(){
                    tabel.style.visibility = 'visible';
                });
            });
        </script>
    @endpush
@endsection

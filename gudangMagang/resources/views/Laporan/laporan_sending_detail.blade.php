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
                    <p>
                        <center><b>{{ $transaksi->kode_pengiriman }}</b></center>
                    </p>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>Penerima :</p>
                        </div>
                        <div class="col-sm-9">
                            <p class = "text-justify">{{$transaksi->nama_pelanggan}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>Alamat :</p>
                        </div>
                        <div class="col-sm-9">
                            <p class = "text-justify">{{$transaksi->alamat_pelanggan}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{-- <label class="col-sm-3">Barang :</label> --}}
                            @php
                                $no = 1;
                            @endphp

                            <table class="col-md-12" border="1px">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center>Nama Produk</center>
                                        </th>
                                        <th>
                                            <center>Jumlah</center>
                                        </th>
                                        <th>
                                            <center>Harga</center>
                                        </th>
                                        <th>
                                            <center>Subtotal</center>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sending as $s)
                                        <tr>
                                            <td>
                                                <center>{{ $no++ }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $s->nama_barang }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $s->jumlah_barang }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $s->harga_jual }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $s->harga_jual * $s->jumlah_barang }}</center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><center>Jumlah Barang</center></th>
                                        <th><center>{{$transaksi->beli_total}}</center></th>
                                        <th><center>Total Harga</center></th>
                                        <th>
                                            <center> {{$transaksi->harga_total}} </center>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <p>Catatan : {{$transaksi->catatan}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <p>Kurir : {{$transaksi->nama_ekspedisi}} (Rp {{$transaksi->ongkir}},-)</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h4><center>TOTAL : Rp {{$transaksi->ongkir + $transaksi->harga_total}},-</center></h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button id="print-button">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('page-script')
    <script type="text/javascript">
         $(document).ready(function() {
        $("#print-button").click(function() {
            var printContents = document.getElementById("print_out").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });
    });

    </script>
@endpush
@endsection

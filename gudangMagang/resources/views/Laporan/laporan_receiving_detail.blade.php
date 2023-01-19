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
                        <center><b>{{ $receive->kode_pengiriman }}</b></center>
                    </p>
                    <p>
                        <center><b>{{ $receive->tanggal_receive }}</b></center>
                    </p>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>Supplier : </p>
                        </div>
                        <div class="col-sm-9">
                            <p>{{ $receive->nama_supplier }} | {{ $receive->nama_supplier }}</p>
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
                                            <center>Kode Produk</center>
                                        </th>
                                        <th>
                                            <center>Jumlah</center>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($receivings as $r)
                                        <tr>
                                            <td>
                                                <center>{{ $no++ }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->nama_barang }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->kode_barang }}</center>
                                            </td>
                                            <td>
                                                <center>{{ $r->jumlah_barang }}</center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
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

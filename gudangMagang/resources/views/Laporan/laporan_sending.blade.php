@extends('index')
@section('content')
    <!--List Barang-->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Transaksi Pengiriman</h3>
                        </div>
                        <!--Button Modal-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <center>No</center>
                                    </th>
                                    <th>
                                        <center>Kode Pengiriman</center>
                                    </th>
                                    <th>
                                        <center>Tanggal Transaksi</center>
                                    </th>
                                    <th>
                                        <center>Action</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($transaksi as $t)
                                    <tr>
                                        <td>
                                            <center>{{ $no++ }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $t->kode_pengiriman }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $t->tanggal_transaksi }}</center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="/sent/{{ $t->kode_pengiriman }}">
                                                    <button type="button" class="btn btn-link btn-fw">View More</button>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <center>Belum Ada Data</center>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><br>
                    <div class="d-flex justify-content-center">
                        {!! $transaksi->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

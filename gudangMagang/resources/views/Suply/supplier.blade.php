@extends('index')
@section('content')
    {{-- Search Box --}}
    {{-- <br>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search" />
                    <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
                </div>
                <span class="close" onclick="searchToggle(this, event);"></span>
            </div>
        </div>
    </div><br> --}}
    <p>Cari Data Pegawai :</p>
	<form action="/supplier/search" method="GET">
		<input type="text" name="cari" placeholder="Cari Pegawai .." value="{{ old('cari') }}">
		<input type="submit" value="CARI">
	</form>

    {{-- Table Supplier --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Daftar Supplier</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <center>No</center>
                                    </th>
                                    <th>
                                        <center>Kode Supplier</center>
                                    </th>
                                    <th>
                                        <center>Nama Supplier</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($supplier as $s)
                                    <tr>
                                        <td>
                                            <center>{{ $no++ }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $s->kode_supplier }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $s->nama_supplier }}</center>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <center>Belum Ada Data</center>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary" id="modal">Tambah Supplier</button>
        </div>
    </div>
@endsection

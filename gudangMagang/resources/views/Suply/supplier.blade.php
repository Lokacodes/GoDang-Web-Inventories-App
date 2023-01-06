@extends('index')
@section('content')
    {{-- Search Box --}}
    <br><div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search" />
                    <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
                </div>
                <span class="close" onclick="searchToggle(this, event);"></span>
            </div>
        </div>
    </div><br>

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
                                    <th>
                                        <center>Alamat</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

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

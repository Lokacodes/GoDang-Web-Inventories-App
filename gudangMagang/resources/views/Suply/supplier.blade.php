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

    <div class="modal fade" id="addTodoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Supplier</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="ver" id="ver" value="0">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                
                                <div class="form-group">
                                    <label for="kode_supplier">Kode Supplier</label>
                                    <input type="text" class="form-control" id="kode_supplier" name="kode_supplier"
                                        placeholder="Kode Supplier">
                                </div>
                                <div class="form-group">
                                    <label for="nama_supplier">Nama supplier</label>
                                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                        placeholder="Nama Supplier">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Supplier</label>
                                    <input type="text" class="form-control"
                                        id="alamat" name="alamat" placeholder="Alamat Supplier">
                                </div>
                                
                                
                            </div>
                            <span id="taskError" class="alert-message"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-user btn-block" id="tambah"
                        type="submit">Save</button>
                    <button type="button" class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--JS Modal-->
    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#modal').click(function() {
                    $('#addTodoModal').modal('show');
                    $('#ver').val("0");
                });
                $('#tambah').click(function() {
                    let kode_supplier = $('#kode_supplier').val();
                    let nama_supplier = $('#nama_supplier').val();
                    let alamat = $('#alamat').val();
                    var ver = $('#ver').val();

                    //Store Kategori
                    if (kode_supplier != "" && nama_supplier != "" && alamat != "" && ver == "0") {
                        $.ajax({
                            url: "/supplier/store",
                            type: "POST",
                            data: {
                                _token: $("#csrf").val(),
                                kode_supplier: kode_supplier,
                                nama_supplier: nama_supplier,
                                alamat: alamat,
                            },
                            success: function(data) {
                                if (data)
                                    alert(data.message);
                                window.location = "/supplier";
                                $('#kode_supplier').val("");
                                $('#nama_supplier').val("");
                                $('#alamat').val("");
                                
                            },
                            error: function(response) {
                                let data = response.responseJSON.error;
                                $.each(data, function(key, value) {
                                    alert(data.message);
                                });
                                alert(data.message);
                            }
                        });
                    } else {
                        alert('Lengkapi isian data !');
                    }
                });
            });
        </script>

        <script>
            function hanyaAngka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                    return false;
                return true;
            }
        </script>
    @endpush
@endsection

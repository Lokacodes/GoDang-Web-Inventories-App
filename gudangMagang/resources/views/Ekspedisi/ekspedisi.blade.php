@extends('index')
@section('content')
    {{-- Search Box --}}
    {{-- <p>Cari Data Ekspedisi :</p>
	<form action="/ekspedisi/search" method="GET">
		<input type="text" name="cari" placeholder="Cari ekspedisi" value="{{ old('cari') }}">
		<input type="submit" value="CARI">
	</form> --}}

    {{-- Table ekspedisi --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Ekspedisi List</h3>
                        </div>
                        <!--Button Modal-->
                        <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="modal">ADD NEW!</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <center>No</center>
                                    </th>
                                    <th>
                                        <center>Kode Ekspedisi</center>
                                    </th>
                                    <th>
                                        <center>Nama Ekspedisi</center>
                                    </th>
                                    <th>
                                        <center>Ongkos Kirim</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($ekspedisi as $ek)
                                    <tr>
                                        <td>
                                            <center>{{ $no++ }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $ek->kode_ekspedisi }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $ek->nama_ekspedisi }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $ek->ongkir }}</center>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
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
        
    </div>

    <div class="modal fade" id="addTodoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Ekspedisi</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="ver" id="ver" value="0">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                
                                <div class="form-group">
                                    <label for="kode_ekspedisi">Kode ekspedisi</label>
                                    <input type="text" class="form-control" id="kode_ekspedisi" name="kode_ekspedisi"
                                        placeholder="Kode ekspedisi">
                                </div>
                                <div class="form-group">
                                    <label for="nama_ekspedisi">Nama ekspedisi</label>
                                    <input type="text" class="form-control" id="nama_ekspedisi" name="nama_ekspedisi"
                                        placeholder="Nama ekspedisi">
                                </div>
                                <div class="form-group">
                                    <label for="ongkir">Ongkos Kirim</label>
                                    <input type="text" class="form-control"
                                        id="ongkir" name="ongkir" placeholder="Ongkos Kirim">
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
                    let kode_ekspedisi = $('#kode_ekspedisi').val();
                    let nama_ekspedisi = $('#nama_ekspedisi').val();
                    let ongkir = $('#ongkir').val();
                    var ver = $('#ver').val();

                    //Store Kategori
                    if (kode_ekspedisi != "" && nama_ekspedisi != "" && ongkir != "" && ver == "0") {
                        $.ajax({
                            url: "/ekspedisi/store",
                            type: "POST",
                            data: {
                                _token: $("#csrf").val(),
                                kode_ekspedisi: kode_ekspedisi,
                                nama_ekspedisi: nama_ekspedisi,
                                ongkir: ongkir,
                            },
                            success: function(data) {
                                if (data)
                                    alert(data.message);
                                window.location = "/ekspedisi";
                                $('#kode_ekspedisi').val("");
                                $('#nama_ekspedisi').val("");
                                $('#ongkir').val("");
                                
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

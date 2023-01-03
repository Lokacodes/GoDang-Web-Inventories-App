@extends('index')
@section('content')
    <!--List IOT-->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Barang List</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>Kode Barang</center>
                                </th>
                                <th>
                                    <center>Nama Barang</center>
                                </th>
                                <th>
                                    <center>Brand</center>
                                </th>
                                <th>
                                    <center>Harga Jual</center>
                                </th>
                                <th>
                                    <center>Deskripsi</center>
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
        <button type="button" class="btn btn-primary" id="modal">ADD NEW!</button>
    </div>

    <div class="modal fade" id="addTodoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="ver" id="ver" value="0">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option selected value="-">-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" name="brand" id="brand">
                                        <option selected value="-">-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                        placeholder="Kode Barang">
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        placeholder="Nama Barang">
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                                        placeholder="harga_jual">
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
                    let id_kategori = $('#id_kategori').val();
                    let kategori = $('#kategori').val();
                    var ver = $('#ver').val();

                    //Store Kategori
                    if (id_kategori != "" && kategori != "" && ver == "0") {
                        $.ajax({
                            url: "/kategori/store",
                            type: "POST",
                            data: {
                                _token: $("#csrf").val(),
                                id_kategori: id_kategori,
                                kategori: kategori,
                            },
                            success: function(data) {
                                if (data)
                                    alert(data.message);
                                window.location = "/kategori";
                                $('#id_kategori').val("");
                                $('#kategori').val("");
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
    @endpush
@endsection

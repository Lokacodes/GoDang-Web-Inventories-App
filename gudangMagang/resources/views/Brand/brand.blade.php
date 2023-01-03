@extends('index')

@section('content')
    <!--List Barang-->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Brand List</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>
                                    <center>Nama Brand</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($brand as $br)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $br->nama_brand }}</center>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
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
        <button type="button" class="btn btn-primary" id="modal">Tambah Brand</button>
    </div>

    <div class="modal fade" id="addTodoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ADD NEW</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="ver" id="ver" value="0">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                <div class="form-group">
                                    <label for="kode_brand">KODE brand</label>
                                    <input type="text" class="form-control" id="kode_brand" name="kode_brand"
                                        placeholder="ID brand (2 Karakter)" maxlength="2"
                                        onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="nama_brand">Nama brand</label>
                                    <input type="text" class="form-control" id="nama_brand" name="nama_brand"
                                        placeholder="brand">
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
                    let kode_brand = $('#kode_brand').val();
                    let nama_brand = $('#nama_brand').val();
                    var ver = $('#ver').val();

                    //Store brand
                    if (kode_brand != "" && nama_brand != "" && ver == "0") {
                        $.ajax({
                            url: "/brand/store",
                            type: "POST",
                            data: {
                                _token: $("#csrf").val(),
                                kode_brand: kode_brand,
                                nama_brand: nama_brand,
                            },
                            success: function(data) {
                                if (data)
                                    alert(data.message);
                                window.location = "/brand";
                                $('#kode_brand').val("");
                                $('#nama_brand').val("");
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

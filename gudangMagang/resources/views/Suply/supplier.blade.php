@extends('index')
@section('content')

    {{-- Table Supplier --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Supplier List</h3>
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
                                    <th width="100px">
                                        <center>No</center>
                                    </th>
                                    <th style="display: none">
                                        <center>Kode Supplier</center>
                                    </th>
                                    <th>
                                        <center>Nama Supplier</center>
                                    </th>
                                    <th width="250px">
                                        <center>Status</center>
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
                                        <td style="display:none">
                                            <center>{{ $s->kode_supplier }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $s->nama_supplier }}</center>
                                        </td>
                                        <td>
                                            <center>
                                                @if ($s->status == 1)
                                                    <a href="/supplier/status/0/{{ $s->id }}">
                                                        <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                                    </a>
                                                @elseif ($s->status == 0)
                                                    <a href="/supplier/status/1/{{ $s->id }}"><span
                                                            class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                                @endif
                                            </center>
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
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Alamat Supplier">
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
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                alert(msg);
            }
        </script>
    @endpush
@endsection

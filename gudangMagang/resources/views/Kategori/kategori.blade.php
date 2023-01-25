@extends('index')

@section('content')
    <!--Tittle-->
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="row">
                <div class="col-md-8 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Kategori List</h3>
                </div>
                <!--Button Modal-->
                <div class="col-md-4 d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary" id="modal">Tambah Kategori</button>
                </div>
            </div>
        </div>
        <!--List Kategori-->
        <div class="col-lg-12">
            <div class="row">
                @forelse ($kategori as $k)
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h3 style="display: none">{{ $k->kode_kategori }}</h3>
                                    <h3 style="text-transform: capitalize; bold">{{ $k->nama_kategori }}</h3>
                                </center>
                                @if ($k->status == 1)
                                    <a href="/kategori/status/0/{{ $k->kode_kategori }}">
                                        <span class="btn btn-sm btn-success btn-icon-text">Unblock</span>
                                    </a>
                                @elseif ($k->status == 0)
                                    <a href="/kategori/status/1/{{ $k->kode_kategori }}"><span
                                            class="btn btn-sm btn-danger btn-icon-text">Block</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <h4 class="card-title">Kategori Kosong</h4>
                                </center>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!--Modal Kategori-->
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
                                    <label for="kode_kategori">KODE Kategori</label>
                                    <input type="text" class="form-control" id="kode_kategori" name="kode_kategori"
                                        placeholder="ID Kategori (2 Karakter)" maxlength="2"
                                        onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                        placeholder="Kategori">
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
                    let kode_kategori = $('#kode_kategori').val();
                    let nama_kategori = $('#nama_kategori').val();
                    var ver = $('#ver').val();

                    //Store Kategori
                    if (kode_kategori != "" && nama_kategori != "" && ver == "0") {
                        $.ajax({
                            url: "/kategori/store",
                            type: "POST",
                            data: {
                                _token: $("#csrf").val(),
                                kode_kategori: kode_kategori,
                                nama_kategori: nama_kategori,
                            },
                            success: function(data) {
                                if (data)
                                    alert(data.message);
                                window.location = "/kategori";
                                $('#kode_kategori').val("");
                                $('#nama_kategori').val("");
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

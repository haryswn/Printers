@extends('master')
@section('konten')

<div class="container-fluid">
    <div class="text-end m-2"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahproduk"> + Tambah produk Baru</button></div>
    @if(session('message'))
    <div class="alert alert-success m-3"> {{session('message')}} </div>
    @endif
    <table class="table table-dark table-hover m-lg-2">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>spesifikasi</th>           
            <th>Harga</th>
            <th>Option</th>
        </tr>
        @foreach ($produk as $p)
        <tr>
            <td> {{$p->kode}}<br><img src="/assets/img/{{$p->gambar}}" alt="" width="80px" height="100px"> </td>
            <td> {{$p->nama}} </td>
            <td> {{$p->spesifikasi}} </td>
            <td>Rp. {{$p->harga}} </td>
            <td> {{$p->stok}} </td>
            <td>

                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ModalUpdateproduk{{ $p->kode }}">Update</button>
                |
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteproduk{{ $p->kode }}">Delete</button>
            </td>
        </tr>

        <!-- Ini tampil form update produk -->
        <div class="modal fade" id="ModalUpdateproduk{{ $p->kode }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/produk/storeupdate" method="post" class="form-floating">
                            @csrf
                            <div class="form-floating p-1">
                                <input type="text" name="id_printer" id="kode" readonly class="form-control" value="{{ $p->id_printer }}">
                                <label for="floatingInputValue">Id printer</label>
                            </div>
                            <div class="form-floating p-1">
                                <input type="text" name="nama" required="required" class="form-control" value="{{ $p->nama }}">
                                <label for="floatingInputValue">Nama</label>
                            </div>
                            <div class="form-floating p-1">
                                <input type="text" name="spesifikasi" required="required" class="form-control" value="{{ $p->spesifikasi }}">
                                <label for="floatingInputValue">spesifikasi</label>
                            </div>
                            <div class="form-floating p-1">
                                <input type="text" name="harga" required="required" class="form-control" value="{{ $p->harga }}">
                                <label for="floatingInputValue">Harga (Rp.)</label>
                            </div>
                            </div>
                            <div class="form-floating p-1">
                                <input type="gambar" name="gambar" required="required" class="form-control" value="{{ $p->gambar }}">
                                <label for="floatingInputValue">Gambar</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Updates</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ini tampil form delete produk -->
        <div class="modal fade" id="ModalDeleteproduk{{$p->id_printer}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/produk/delete/{{$p->id_printer}}" method="get" class="form-floating">
                            @csrf
                            <div>
                                <h3>Yakin mau menghapus data <b>{{$p->nama}}</b> ?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </table>
</div>

<!-- Ini tampil form tambah produk -->
<div class="modal fade" id="ModalTambahproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/produk/storeinput" method="post" class="form-floating" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating p-1">
                        <input type="text" name="nama" required="required" class="form-control">
                        <label for="floatingInputValue">Nama</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="spesifikasi" required="required" class="form-control">
                        <label for="floatingInputValue">spesifikasi</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="harga" required="required" class="form-control">
                        <label for="floatingInputValue">Harga (Rp.)</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="gambar" required="required" class="form-control">
                        <label for="floatingInputValue">Gambar</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
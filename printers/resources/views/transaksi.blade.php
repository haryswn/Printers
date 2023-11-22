@extends('master')
@section('konten')

<div class="container-fluid">
    @if(session('message'))
    <div class="alert alert-success m-3"> {{session('message')}} </div>
    @endif
    <table class="table table-dark table-hover m-lg-2">
        <tr>
            <th>Id Transaksi</th>
            <th>Id printer</th>
            <th>Jumlah</th>
            <th>Bayar</th>
            @if(Auth::user()->role!='Guest')
            <th>Id Transaksi</th>
            @endif
            <th>Status</th>
            @if(Auth::user()->role!='Guest')
            <th>Option</th>
            @endif
        </tr>
        @foreach ($transaksi as $p)
        <tr>
            <td> {{$p->id_transaksi}} </td>
            <td> {{$p->id_printer}} </td>
            <td> {{$p->jumlah}} </td>
            <td>Rp. {{$p->bayar}} </td>
            @if(Auth::user()->role!='Guest')
            <td> {{$p->kode_pembeli}} </td>
            @endif
            <td>
                @if(Auth::user()->role!='Guest')
                @if($p->status=='verifikasi')
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUpdatepembelian{{ str_replace('/','',$p->kode_pembelian) }}">
                    {{$p->status}}
                </button>
                @elseif($p->status=='proses')
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUpdatepembelian{{ str_replace('/','',$p->kode_pembelian) }}">
                    {{$p->status}}
                </button>
                @elseif($p->status=='kirim')
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ModalUpdatepembelian{{ str_replace('/','',$p->kode_pembelian) }}">
                    {{$p->status}}
                </button>
                @elseif($p->status=='selesai')
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalUpdatepembelian{{ str_replace('/','',$p->kode_pembelian) }}">
                    {{$p->status}}
                </button>
                @endif
                @else
                <button class="btn btn-primary">{{$p->status}}</button>
                @endif
            </td>
            @if(Auth::user()->role!='Guest')
            <td>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletepembelian{{ $p->id_transaksi }}">Delete</button>
            </td>
            @endif
        </tr>

        <!-- Ini tampil form update pembelian -->
        <div class="modal fade" id="ModalUpdatepembelian{{ str_replace('/','',$p->id_transaksi) }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update pembelian</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/pembelian/storeupdate" method="post" class="form-floating">
                            @csrf
                            <div class="form-floating p-1">
                                <input type="text" name="id_transaksi" id="kode_pembelian" readonly class="form-control" value="{{ $p->kode_pembelian }}">
                                <label for="floatingInputValue">Id Transaksi</label>
                            </div>
                            <div class="form-floating p-1">
                                <select name="status" class="form-control">
                                    <option value="verifikasi" @if($p->status =='verifikasi') selected="selected" @endif>Verifikasi</option>
                                    <option value="proses" @if($p->status =='proses') selected="selected" @endif>Proses</option>
                                    <option value="kirim" @if($p->status =='kirim') selected="selected" @endif>Kirim</option>
                                    <option value="selesai" @if($p->status =='selesai') selected="selected" @endif>Selesai</option>
                                </select>
                                <label for="floatingInputValue">Status</label>
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

        <!-- Ini tampil form delete pembelian -->
        <div class="modal fade" id="ModalDeletepembelian{{$p->id_transaksi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus pembelian</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/transaksi/delete/{{$p->id_transaksi}}" method="get" class="form-floating">
                            @csrf
                            <div>
                                <h3>Yakin mau menghapus data <b>{{$p->id_transaksi}}</b> ?</h3>
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
    <a href="/"><button type="button" class="btn btn-primary">Lanjut Pembelian</button></a>
</div>
<!-- Ini tampil form tambah pembelian -->
<div class="modal fade" id="ModalTambahpembelian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pembelian/storeinput" method="post" class="form-floating">
                    @csrf
                    <div class="form-floating p-1">
                        <input type="text" name="id_pembelian" required="required" class="form-control">
                        <label for="floatingInputValue">Kode Pembelian</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="kode_printer" required="required" class="form-control">
                        <label for="floatingInputValue">Id Printer</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="jumlah" required="required" class="form-control">
                        <label for="floatingInputValue">Jumlah</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="bayar" required="required" class="form-control">
                        <label for="floatingInputValue">Bayar (Rp.)</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="id_transaksi" required="required" class="form-control">
                        <label for="floatingInputValue">Id transaksi</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="status" required="required" class="form-control">
                        <label for="floatingInputValue">Status</label>
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
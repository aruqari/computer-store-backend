@extends('layout.layout')

@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Transaksi</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Transaksi</h4>
                    </div>

                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>Id Pembelian</th>
                                    <th>Id_user</th>
                                    <th>Nama Pembeli</th>
                                    <th>Tanggal & Waktu Dipesan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $item->id_pembelian }}</td>
                                        <td>{{ $item->id_user }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status == 'Diproses')
                                                <span class="badge badge-primary">{{ $item->status }}</span>
                                            @elseif($item->status == 'Dibayar')
                                                <span class="badge badge-info">{{ $item->status }}</span>
                                            @elseif($item->status == 'Belum Dibayar')
                                                <span class="badge badge-warning">{{ $item->status }}</span>
                                            @elseif($item->status == 'Selesai')
                                                <span class="badge badge-success">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td style="min-width: 15vh">
                                            <a href="#" class="btn btn-sm btn-success rounded-pill"
                                                data-toggle="modal" data-target="#detailModal{{ $item->id_pembelian }}"
                                                id="detail{{ $item->id_pembelian }}">Ubah Status</a>
                                            <a href="/transaksi/{{ $item->id_pembelian }}"
                                                class="btn btn-sm btn-info rounded-pill">Detail</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $transaksi->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@foreach ($transaksi as $item)
    <div class="modal fade" tabindex="-1" role="dialog" id="detailModal{{ $item->id_pembelian }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status {{ $item->id_pembelian }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/transaksi/ubahStatus" method="POST">
                    <div class="modal-body d-flex flex-column">
                        <div class="form-group">
                            <label>Pilih Status</label>
                            <select class="custom-select" name="status">
                                <option selected>{{ $item->status }}</option>
                                <option value="Dibayar">Dibayar</option>
                                <option value="Belum Dibayar">Belum Dibayar</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        @csrf
                        <input type="hidden" name="id_pembelian" value="{{ $item->id_pembelian }}">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

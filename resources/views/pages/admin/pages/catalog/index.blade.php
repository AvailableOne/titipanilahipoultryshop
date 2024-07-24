@extends('pages.admin.layouts.main')
@section('container')
    <div class="container-fluid pt-4 px-4">
        <h1 class="h3 mb-2 text-gray-800">Halaman Katalog</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" class="btn btn-primary float-right" data-bs-toggle="modal"
                    data-bs-target="#TambahModal">Tambah Katalog</a>
            </div>
            <div class="card-body">
                @if (session()->has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Katalog</th>
                                <th>Jumlah Barang Pada Katalog</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catalog as $catalog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $catalog->name }}</td>
                                    <td>{{ $catalog->products->count() }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('admin.pages.catalog.products', $catalog) }}"
                                            class="btn btn-primary btn-circle me-2" title="List Produk"><i
                                                class="fa fa-th-list nav-icon"></i></a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#EditModal{{ $catalog->id }}"
                                            class="btn btn-warning btn-circle me-2" title="Edit Data"><i
                                                class="fas fa-edit nav-icon" style="color: #fff"></i></a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#HapusModal{{ $catalog->id }}"
                                            class="btn btn-danger btn-circle" title="Hapus Data"><i
                                                class="fa fa-trash nav-icon"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal Edit-->
                                <div class="modal fade" id="EditModal{{ $catalog->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Edit Data Katalog</h4>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('catalog.update') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $catalog->id }}">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Nama Katalog" value="{{ $catalog->name }}"
                                                        required><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus-->
                                <div class="modal fade" id="HapusModal{{ $catalog->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Hapus Data Katalog</h4>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('catalog.delete') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $catalog->id }}">
                                                    <p>Apakah Anda Yakin Ingin Menghapus {{ $catalog->name }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Katalog</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('catalog.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" placeholder="Nama Katalog"
                            required><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('pages.admin.layouts.main')
@section('container')
    <div class="container-fluid pt-4 px-4">
        <h1 class="h3 mb-2 text-gray-800">Halaman Produk</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" class="btn btn-primary float-right" data-bs-toggle="modal"
                    data-bs-target="#TambahModal">Tambah Produk</a>
            </div>
            <div class="card-body">
                @if (session()->has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar Produk</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi Produk</th>
                                <th>Harga Produk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img style="width: 80px" class="imageimg-thumbnail"
                                            src="{{ asset('storage/item/' . $product->picture) }}" alt=""></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td id="product-price-{{ $product->id }}" data-price="{{ $product->price }}"></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#EditModal{{ $product->id }}"
                                            class="btn btn-warning btn-circle me-2" title="Edit Data"><i
                                                class="fas fa-edit nav-icon" style="color: #fff"></i></a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#HapusModal{{ $product->id }}"
                                            class="btn btn-danger btn-circle" title="Hapus Data"><i
                                                class="fa fa-trash nav-icon"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal Edit-->
                                <div class="modal fade" id="EditModal{{ $product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Edit Data Produk</h4>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.update', ['id' => $product->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <!-- Add your form fields for product edit here -->
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Produk</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $product->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Deskripsi</label>
                                                        <input id="edit-{{ $product->id }}"
                                                            value="{{ $product->description }}" type="hidden"
                                                            name="description">
                                                        <trix-editor input="edit-{{ $product->id }}"></trix-editor>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editPrice" class="form-label">Harga</label>
                                                        <input type="text" id="editPrice" name="editPrice"
                                                            class="form-control price-input" value="{{ $product->price }}"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Category</label>
                                                        <select name="category_id" class="form-control" required>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if ($product->category_id == $category->id) selected @endif>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="catalog_id" class="form-label">Catalog</label>
                                                        <select name="catalog_id" class="form-control" required>
                                                            @foreach ($catalogs as $catalog)
                                                                <option value="{{ $catalog->id }}"
                                                                    @if ($product->catalog_id == $catalog->id) selected @endif>
                                                                    {{ $catalog->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="picture" class="form-label">Gambar</label>
                                                        <input type="file" name="picture" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Hapus-->
                                <div class="modal fade" id="HapusModal{{ $product->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Hapus Data Produk</h4>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('product.delete', ['id' => $product->id]) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <p>Apakah Anda Yakin Ingin Menghapus Produk: {{ $product->name }}?
                                                    </p>
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Produk</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <input id="tambah" type="hidden" name="description">
                            <trix-editor input="tambah"></trix-editor>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="text" name="price" id="priceTambah" class="form-control price-input"
                                required>
                        </div>
                        <!-- Pilihan kategori dan katalog -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catalog_id" class="form-label">Catalog</label>
                            <select name="catalog_id" class="form-control" required>
                                <option value="" disabled selected>Select a catalog</option>
                                @foreach ($catalogs as $catalog)
                                    <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Gambar</label>
                            <input type="file" name="picture" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to format price input
            function formatPriceInput(input) {
                let inputValue = input.value.replace(/\D/g, '');
                inputValue = new Intl.NumberFormat('id-ID').format(inputValue);
                inputValue = 'Rp. ' + inputValue;
                input.value = inputValue;
            }

            // Format price input on keyup
            const priceInputs = document.querySelectorAll('.price-input');
            priceInputs.forEach(function(priceInput) {
                priceInput.addEventListener('keyup', function(event) {
                    formatPriceInput(event.target);
                });
            });

            // Function to format Rupiah
            function formatRupiah(value) {
                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Format product prices
            const priceElements = document.querySelectorAll('[id^="product-price-"]');
            priceElements.forEach(function(priceElement) {
                const price = priceElement.getAttribute("data-price");
                priceElement.textContent = formatRupiah(price);
            });
        });
    </script>
@endsection

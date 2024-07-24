@extends('pages.admin.layouts.main')
@section('container')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <a href="/admin/katalog" class="bg-light rounded d-flex align-items-center justify-content-between p-4"><i
                        class="fa fa-table fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Katalog</p>
                        <h6 class="mb-0">{{ $catalogs }}</h6>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a href="/admin/kategori" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-table fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Kategori</p>
                        <h6 class="mb-0">{{ $categories }}</h6>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a href="/admin/produk" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-table fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Produk</p>
                        <h6 class="mb-0">{{ $products }}</h6>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a href="/admin/pengguna" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Pengguna</p>
                        <h6 class="mb-0">{{ $users }}</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection

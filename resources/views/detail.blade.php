@extends('layouts.main')
@section('container')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Produk</h1>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('storage/item/' . $detail->picture) }}" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $detail->name }}</h4>
                            <p class="mb-3">Kategori: {{ $detail->category->name }}</p>
                            <h5 class="fw-bold mb-3" id="product-price-{{ $detail->id }}"
                                data-price="{{ $detail->price }}"></h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <a href="{{ route('addproduct.to.cart', $detail->id) }}"
                                class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Masuk Keranjang
                            </a>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Deskripsi</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-1">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <td>{!! $detail->description !!}</td>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    @foreach ($categories as $category)
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                {{ $category->name }}
                                                <span>({{ $category->products_count }})</span>
                                                <!-- Menggunakan products_count -->
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Related Products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($relatedProducts as $product)
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <a href="/produk/{{ $product->slug }}">
                                <div class="vesitable-img">
                                    <img src="{{ asset('storage/item/' . $product->picture) }}"
                                        class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">{{ $product->category->name }}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{ $product->name }}</h4>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">${{ number_format($product->price, 2) }}</p>
                                        <a href="{{ route('addproduct.to.cart', $product->id) }}"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Masuk Keranjng
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection

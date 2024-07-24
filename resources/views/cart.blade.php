@extends('layouts.main')

@section('container')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Keranjang</h1>
    </div>

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            @if (session('cart') && count(session('cart')) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach (session('cart') as $id => $details)
                                <tr rowId="{{ $id }}">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="storage/item/{{ $details['picture'] }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $details['name'] }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4" id="product-price-{{ $id }}-price"
                                            data-price="{{ $details['price'] }}">{{ $details['price'] }}</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <a href="{{ route('decrease.quantity', ['id' => $id]) }}"
                                                    class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </div>
                                            <p class="form-control form-control-sm text-center border-0">
                                                {{ $details['quantity'] }}</p>
                                            <div class="input-group-btn">
                                                <a href="{{ route('increase.quantity', ['id' => $id]) }}"
                                                    class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4" id="product-price-{{ $id }}-total"
                                            data-price="{{ $details['price'] * $details['quantity'] }}">
                                            {{ $details['price'] * $details['quantity'] }}</p>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete.cart.product', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4" id="product-price-{{ $id }}-total"
                                    data-price="{{ $total }}">
                                    {{ $total }}</p>
                            </div>
                            <button
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                type="button">Proceed Checkout</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <h1 class="mb-5">Keranjang belanja Anda kosong.</h1>
                    <a href="/produk" class="btn btn-primary border-2 border-secondary text-white">Belanja Sekarang</a>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->
@endsection

@extends('user.web.layouts.base')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
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
                                    <img id="mainImage" src="{{ Storage::url($produk->foto_produk) }}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                            <div class="mt-3 d-flex flex-wrap thumbnails">
                                @foreach ($produk->thumbnails as $thumbnail)
                                    <div class="thumbnail me-2 mb-2">
                                        <img src="{{ Storage::url($thumbnail) }}" class="img-thumbnail" alt="Thumbnail" data-src="{{ Storage::url($thumbnail) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $produk->nama_produk }}</h4>
                            <h5 class="mb-3">Category : </h5>
                            <p class="btn btn-warning">{{ $produk->category }}</p>
                            <h5 class="text-dark">Stok :</h5>
                            <p class="text-dark">{{ $produk->stok }} buah | {{ $produk->box }} box</p>
                            <h5 class="fw-bold mb-3">Rp. {{ number_format($produk->harga, 0, ',', '.') }} / kg</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h6>Deskripsi produk :</h6>
                            <p class="mb-3">{{ $produk->deskripsi }}</p>
                            @auth
                                @if($produk->stok > 0)
                                    <a href="{{ route('user.checkout') }}" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i>Pesan Sekarang
                                    </a>
                                @else
                                    <button class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-secondary" disabled>
                                        <i class="fa fa-shopping-bag me-2 text-secondary"></i>Stok Habis
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>Pesan Sekarang
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="{{ Storage::url($relatedProduct->foto_produk) }}" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{ $relatedProduct->category }}</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>{{ $relatedProduct->nama_produk }}</h4>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fw-bold">Rp. {{ number_format($relatedProduct->harga, 0, ',', '.') }}</p>
                                    <a href="{{ route('user.detail', $relatedProduct->id) }}" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    <!-- JavaScript for handling thumbnail clicks -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumbnail img');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function () {
                    const newSrc = this.getAttribute('data-src');
                    mainImage.setAttribute('src', newSrc);
                });
            });
        });
    </script>
    
    <!-- CSS for thumbnail styling -->
    <style>
        .thumbnails .thumbnail img {
            width: 80px; /* Adjust the width as needed */
            height: auto;
        }
        .thumbnails {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        .thumbnails .thumbnail {
            flex: 0 0 auto;
        }
    </style>
@endsection

@extends('user.web.layouts.base')

@section('content')
       <!-- Single Page Header start -->
       <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Contact</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Tentang Perusahaan</h1>
                            <p class="mb-4">PT Sata Harum memiliki luas perkebunan yakni 92 hektare yang terbagi 
                                dalam beberapa blok-blok petak perkebunan. Instansi yang bergerak di bidang 
                                perkebunan Mangga Harum Manis ini sering menangani permintaan calon 
                                customer baik di dalam daerah Probolinggo sendiri maupun di luar daerah dalam provinsi Jawa Timur.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <div style="max-width:100%;overflow:hidden;color:red;width:1500px;height:500px;"><div id="google-maps-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=PT.+SATA+HARUM&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div><a class="google-map-code-enabler" href="https://www.bootstrapskins.com/themes" id="authorize-map-data">premium bootstrap themes</a><style>#google-maps-canvas img{max-height:none;max-width:none!important;background:none!important;}</style></div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="https://api.web3forms.com/submit" class="" method="POST">
                            <input type="hidden" name="access_key" value="47e6e6a8-2fc3-46ea-8b49-ed366afcb47d">
                            <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name" name="name"  required>
                            <input type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email" name="email"  required>
                            <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message" name="message" required></textarea>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Alamat</h4>
                                <p class="mb-2">Jl.KH Idris No.143, Dusun Krajan 1, Betektaman, Kec. Gading, Kabupaten Probolinggo, Jawa Timur</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Email</h4>
                                <p class="mb-2">satriyaarrom@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Nomor Telepon</h4>
                                <p class="mb-2">082334391141</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
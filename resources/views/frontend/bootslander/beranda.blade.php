@extends('frontend.bootslander.template.index')
@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ url('templates/bootslander') }}/img/hero-bg-2.jpg" alt="" class="hero-bg">

        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <div class="animated">
                        <img src="{{ url('storage') . '/' . $office->leader_image }}" class="img-fluid " alt="">
                        <div class="bg-white  text-center px-3 py-3"
                            style="position: absolute;left:0;right:0;bottom:0;border-radius:50px;">
                            <h5 class="text-dark m-0">
                                {{ $office->leader_name }}
                            </h5>
                            <h6 class="text-dark">
                                {{ $office->leader_position }}
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
                    <h1>{{ $office->name }} <span>Kabupaten Tapin</span></h1>
                    <p>Pemerintahan Kabupaten Tapin yang Mewujudkan Tapin Maju, Sejahtera dan Agamis</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">
                            Informasi Kami
                        </a>
                        {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i>
                            <span>
                                Sambutan
                            </span>
                        </a> --}}
                    </div>
                </div>

            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                </path>
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3"></use>
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0"></use>
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9"></use>
            </g>
        </svg>

    </section><!-- /Hero Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

        <div class="container">

            <div class="row gy-4">

                @foreach ($office->officeServices as $item)
                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="features-item">
                            {{-- <i class="bi bi-eye" style="color: #ffbb2c;"></i> --}}
                            <img src="{{ url('storage/' . $item->thumb) }}" alt="">
                            <h3>
                                <a href="" class="stretched-link">{{ $item->title }}</a>
                            </h3>
                        </div>
                    </div><!-- End Feature Item -->
                @endforeach
            </div>

        </div>

    </section><!-- /Features Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-book"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $office->ppids->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>PPID</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-file-pdf"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $office->publications->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Publikasi</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-journal-richtext"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $office->posts->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Postingan</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-images"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $office->galleries->count() }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Galeri</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Details Section -->
    <section id="details" class="details section">


        <div class="container">

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
                    <img src="{{ url('templates/bootslander') }}/img/details-3.png" class="img-fluid" alt="">
                </div>
                <div class="col-md-7" data-aos="fade-up">
                    <div class="container section-title" data-aos="fade-up">
                        <h2>Kategori</h2>
                        <div><span>Pengumuman</span></div>
                        <p>Berisi pengumuman resmi dari seluruh dinas pemerintahan Kabupaten Tapin yang dapat diakses oleh
                            masyarakat secara terbuka.</p>
                    </div>

                    @php
                        $posts = @$office
                            ->posts()
                            ->orderBy('id', 'DESC')
                            ->whereHas('postCategories', function ($query) {
                                return $query->where('name', 'Pengumuman');
                            })
                            ->limit(6)
                            ->get();
                    @endphp
                    <ul>
                        @forelse ($posts as $item)
                            <li>
                                <a href="{{ route('f.post.show', ['account' => $office->subdomain, 'post' => $item->uuid]) }}"
                                    class="row mb-2">
                                    <div class="col-md-2">
                                        <img src="{{ url('storage') . '/' . $item->thumb }}" class="img-fluid rounded"
                                            width="100%" alt="">
                                    </div>
                                    <div class="col-md-10 text-start text-dark">
                                        <small>
                                            <strong class="text-primary">{{ dateFormat($item->created_at) }}</strong> |
                                        </small>
                                        <span class="">{{ $item->title }}</span>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>
                                <span>
                                    Pengumuman Masih Kosong
                                </span>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-center features-item">

                <div class="col-md-12 order-2 order-md-1" data-aos="fade-up">
                    <div class="container section-title" data-aos="fade-up">
                        <h2>Kategori</h2>
                        <div><span>Berita</span></div>
                        <p>Dapatkan berita terkini seputar kegiatan, program, dan kebijakan dari
                            <b>{{ $office->name }}</b>.
                        </p>
                    </div>
                    @php
                        $berita = @$office
                            ->posts()
                            ->orderBy('id', 'DESC')
                            ->whereHas('postCategories', function ($query) {
                                return $query->where('name', 'Berita');
                            })
                            ->limit(4)
                            ->get();
                    @endphp
                    <div class="row">
                        @foreach ($berita as $item)
                            @if ($loop->iteration == 1)
                                <a href="{{ route('f.post.show', ['account' => $office->subdomain, 'post' => $item->uuid]) }}"
                                    class="col-md-12 mb-2">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <img src="{{ url('storage') . '/' . $item->thumb }}"
                                                class="img-fluid rounded" alt="">
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <h4>{{ $item->title }}</h4>
                                            <div class="text-dark">
                                                {{ dateFormat($item->created_at) }}
                                                <br>
                                                {!! $item->excercept !!}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('f.post.show', ['account' => $office->subdomain, 'post' => $item->uuid]) }}"
                                    class="col-md-4 mb-2">
                                    <img src="{{ url('storage') . '/' . $item->thumb }}" class="img-fluid rounded"
                                        alt="">
                                    <h4>{{ $item->title }}</h4>
                                    <div class="text-dark">
                                        {{ dateFormat($item->created_at) }}
                                        <br>
                                        {!! $item->excercept !!}
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div><!-- Features Item -->

        </div>

    </section><!-- /Details Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Galleries</h2>
            <div><span>Lihat Galeri</span> <span class="description-title">Kami</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            @php
                $galleries = @$office->galleries()->orderBy('id', 'DESC')->limit(8)->get();
            @endphp
            <div class="row g-0">
                @foreach ($galleries as $item)
                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ url('storage/' . $item->image) }}" class="glightbox"
                                data-gallery="images-gallery">
                                <img src="{{ url('storage/' . $item->image) }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div><!-- End Gallery Item -->
                @endforeach
            </div>

        </div>

    </section><!-- /Gallery Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <div><span>Kontak Kami</span> <span class="description-title">{{ $office->subdomain }}</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Alamat</h3>
                            <p>{{ $office->address }}</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Telpon</h3>
                            <p>{{ $office->phone }}</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email</h3>
                            <p>{{ $office->email }}</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="col-lg-8">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name"
                                    required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>
            <div class="mt-4">
                {!! $office->map !!}
            </div>
        </div>

    </section><!-- /Contact Section -->
@endsection

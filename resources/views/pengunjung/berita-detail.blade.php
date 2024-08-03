<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Website PSTRK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">



</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="branding d-flex align-items-cente">

          <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="http://127.0.0.1:8000/pengunjung" class="logo d-flex align-items-center">
                <img src="assets/img/logoTRK.png" alt="PSTRK Logo" style="height: 40px; margin-right: 20px;">
                <h1 class="sitename">PSTRK</h1>
            </a>

            <nav id="navmenu" class="navmenu">
              <ul>
                <li><a href="http://127.0.0.1:8000/pengunjung" >Beranda</a></li>
                <li class="dropdown"><a href=""><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="profilPengunjung">Profil Singkat</a></li>
                    <li><a href="dosenPengunjung">Pengajar</a></li>
                    <li><a href="alumniPengunjung">Prospek Alumni</a></li>
                    <li><a href="himaPengunjung">Himpunan Mahasiswa</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a href=""><span>Akademik</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="http://127.0.0.1:8000/kurikulumPengunjung">Kurikulum</a></li>
                      <li><a href="http://127.0.0.1:8000/akreditasiPengunjung">Akreditasi</a></li>
                      <li><a href="http://127.0.0.1:8000/fasilitasPengunjung">Fasilitas</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a href="" ><span>Berita & Prestasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="http://127.0.0.1:8000/beritaDosen">Berita Dosen</a></li>
                      <li><a href="http://127.0.0.1:8000/beritaMhs">Berita Mahasiswa</a></li>
                      <li><a href="http://127.0.0.1:8000/prestasiDosen">Prestasi Dosen</a></li>
                      <li><a href="http://127.0.0.1:8000/prestasiMhs">Prestasi Mahasiswa</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a href=""><span>Dokumentasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="http://127.0.0.1:8000/kegiatanDosen">Kegiatan Dosen</a></li>
                      <li><a href="http://127.0.0.1:8000/kegiatanMhs">Kegiatan Mahasiswa</a></li>
                      <li><a href="http://127.0.0.1:8000/fotoPengunjung">Foto</a></li>
                      <li><a href="http://127.0.0.1:8000/videoPengunjung">Video</a></li>
                    </ul>
                  </li>
                <li><a href="http://127.0.0.1:8000/faqPengunjung">FAQ</a></li>
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

          </div>

        </div>

    </header>


    <main class="main">

    <!-- Slideshow -->
    <section id="vidio" class="akreditasi">
        <div class="container">

                <div class="row">
                    <div class="col-8">
                        <div class="content">
                            <h3 class="text-pembatas-profil justify-content-start">{{$berita->judul}}</h3>
                            <div class="image-container-sejarah">
                                <img src="{{ url('/storage/foto/'.$berita->lampiran) }}" alt="Program Studi D4 Teknologi Rekayasa Komputer">
                            </div>
                            <div class="text-container-sejarah">
                                <p>{{ $berita->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Prestasi Terbaru -->
                    <div class="col-3 ms-5 p-0">
                        <div class="row mb-4">
                            <div class=" mb-4 pembatas-prestasi2kecil">
                                <h5 class="text-pembatas-prestasi">Berita Terbaru</h5>
                                <img src="assets/img/line 29.png" alt="">
                            </div>
                            <ul class="presdos-latest-list">

                                <li class="border-bottom">
                                    <p class="mb-2"><a href="#">{{ $berita->judul }}</a></p>
                                    <small class="d-block mb-2">{{ $berita->tgl_publish }}</small>
                                </li>

                            </ul>
                        </div>

                        <div class="row">
                            <div class=" mb-4 ms-0 pembatas-prestasi2kecil">
                                <h5 class="text-pembatas-prestasi">Agenda</h5>
                                <img src="assets/img/line 29.png" alt="">
                            </div>
                            <ul class="presdos-latest-list">
                                @foreach($agendas as $agenda)
                                <li class="border-bottom">
                                    <p class="mb-2"><a href="#">{{ $agenda->judul }}</a></p>
                                    <small class="d-block mb-2">{{ $agenda->tgl_mulai }} | {{ $agenda->penyelenggara }}</small>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

        </div>
    </section>

  </main>


  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-3 col-md-3 footer-about border-end">
          <a href="" class="d-flex align-items-center">
            <span class="d-none d-lg-block text-light fs-1 ">P S T R K</span>
          </a>
        </div>

        <div class="col-lg-3 col-md-3 footer-links border-end ">
          <h4 class="text-light">Alamat</h4>
          <ul class="pe-4">
            <li>
              @foreach($kontaks as $kontak)
                <p class="text-break alamat">
                  {{ $kontak->alamat }}
                </p>
                @endforeach
            </li>
            {{-- <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li> --}}
          </ul>
        </div>

        <div class="col-lg-3 col-md-3 footer-links border-end" >
          <h4 class="text-light">Kontak</h4>
          <ul>
            @foreach($kontaks as $kontak)
            <li style="align-: center">{{ $kontak->no_tlp }}</li>
            <li style="align-: center">{{ $kontak->whatsapp }}</li>
            <li style="align-: center">{{ $kontak->email }}</li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-3 col-md-12">
          <h4 class="text-light">Media Sosial</h4>
          <ul class="p-0 m-0">
            @foreach($kontaks as $kontak)
            <li style="list-style: none" class="mb-2">
                <img src="assets/img/youtube.png" alt="" width="24" height="24" class="m-1">
                <a href="#" class="text-light">{{ $kontak->youtube }}</a>
            </li>
            <li style="list-style: none" class="mb-2">
                <img src="assets/img/instagram.png" alt="" width="24" height="24" class="m-1">
                <a href="#" class="text-light">{{ $kontak->instagram }}</a>
            </li>
            @endforeach
          </ul>
        </div>

      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  {{-- <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div> --}}

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main2.js"></script>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>

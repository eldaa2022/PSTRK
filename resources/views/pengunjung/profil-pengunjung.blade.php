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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="branding d-flex align-items-cente">

          <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="/pengunjung" class="logo d-flex align-items-center">
                <img src="assets/img/logoTRK.png" alt="PSTRK Logo" style="height: 40px; margin-right: 20px;">
                <h1 class="sitename">PSTRK</h1>
            </a>

            <nav id="navmenu" class="navmenu">
              <ul>
                <li><a href="/pengunjung" >Beranda</a></li>
                <li class="dropdown"><a href="" class="active"><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="profilPengunjung">Profil Singkat</a></li>
                    <li><a href="dosenPengunjung">Pengajar</a></li>
                    <li><a href="alumniPengunjung">Prospek Alumni</a></li>
                    <li><a href="himaPengunjung">Himpunan Mahasiswa</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a href=""><span>Akademik</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="/kurikulumPengunjung">Kurikulum</a></li>
                      <li><a href="/akreditasiPengunjung">Akreditasi</a></li>
                      <li><a href="/fasilitasPengunjung">Fasilitas</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a href="" ><span>Berita & Prestasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="/beritaDosen">Berita Dosen</a></li>
                      <li><a href="/beritaMhs">Berita Mahasiswa</a></li>
                      <li><a href="/prestasiDosen">Prestasi Dosen</a></li>
                      <li><a href="/prestasiMhs">Prestasi Mahasiswa</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a href=""><span>Dokumentasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="/kegiatanDosen">Kegiatan Dosen</a></li>
                      <li><a href="/kegiatanMhs">Kegiatan Mahasiswa</a></li>
                      <li><a href="/fotoPengunjung">Foto</a></li>
                      <li><a href="/videoPengunjung">Video</a></li>
                    </ul>
                  </li>
                <li><a href="/faqPengunjung">FAQ</a></li>
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

          </div>

        </div>

    </header>



      <main class="main">

    <!-- SEJARAH Section -->
    <section id="Sejarah" class="Sejarah">
        <div class="container">
            <div class="content">
                @foreach ($profils as $profil)
                @if ($profil->tags=='Sejarah')
                <div class="image-container-sejarah">
                    <img src="{{ url('/storage/foto/'.$profil->lampiran) }}" alt="Program Studi D4 Teknologi Rekayasa Komputer">
                </div>
                <div class="text-container-sejarah">
                    <p>{{ $profil->deskripsi }}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- /SEJARAH Section -->

    <!-- kata sambutan Section -->
    <section id="kasam" class="kasam ">
        <div class="container">
            <div class="col-12 mb-2 ms-0" >
                <h3 class="text-pembatas-profil justify-content-start">Sambutan Kaprodi</h3>
            </div>
                <div class="kasam-content">
                    @foreach ($profils as $profil)
                    @if($profil->tags == 'Sambutan Kaprodi')
                    <div class="content-text">
                        <p>{{ $profil->deskripsi }}</p>
                        <p><strong>{{ $profil->judul }}</strong></p>
                    </div>
                    <div class="content-image">
                        <img src="{{ url('/storage/foto/'.$profil->lampiran) }}" alt="Profil" class="kasam-image">
                    </div>
                    @endif
                    @endforeach
                </div>
        </div>
    </section>
    <!-- /kata sambutan Section -->

    <!-- visi misi Section -->
    <section id="visi" class="visi ">
        <div class="container">
            @foreach ($profils as $visi)
            @if ($visi->tags=='Visi')
            <div class="content-box">
                <h2>Visi</h2>
                <p class="description text-center">{{ $visi->deskripsi }}</p>
            </div>
            @endif
            @endforeach

            <div class="content-box">
                <h2>Misi</h2>
                <ul class="list-style">
                    @foreach ($profils as $profil)
                        @if ($profil->tags == 'Misi')
                            @foreach ($profil->deskripsi as $misi)
                                <li>{{ trim($misi) }}</li> <!-- Gunakan trim untuk menghilangkan spasi kosong di sekitar teks -->
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    <!-- /visi misi Section -->

    <!-- prospek Section -->
    <section id="prospek" class="prospek ">
        <div class="container">
            @foreach($profils as $profil)
            @if ($profil->tags=='Prospek Kerja')
            <h3 class="text-center mb-5 fw-bold">{{ $profil->judul }}</h3>

            <div class="content-wrapper">
                <div class="career-list" style="border: 1px solid #FFF7A4; padding: 20px; border-radius: 10px; margin-right: 20px;">
                    <ul>
                        <h6 class="text-center mb-5 fw-bold">Lulusan PSTRK diproyeksikan dapat berkarir sebagai:</h6>
                        @foreach ($profil->deskripsi as $prospek)
                        <li class="text-center">{{ trim($prospek) }}</li> <!-- Gunakan trim untuk menghilangkan spasi kosong di sekitar teks -->
                        @endforeach
                    </ul>
                </div>

                <div class="image-container">
                    <img src="{{ url('/storage/foto/'.$profil->lampiran) }}" alt="Proyeksi Karir">
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>
    <!-- /prospek Section -->


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


   <!-- Pop-up Button -->
   <button class="btn btn-lg btn-pesan fixed-button" id="btn-create-post" data-bs-toggle="modal" data-bs-target="#pesanModal">
    <i class="bi bi-chat-dots"></i>
  </button>

  <!-- Modal Structure -->
  <div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="pesanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formData" method="post" action="{{ route('pesans.store') }}">
          <div class="modal-header">
            <h5 class="modal-title" id="pesanModalLabel">Kirim Pesan</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="isi_pesan">Pesan</label>
              <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="4" required></textarea>
            </div>
            <div id="alert-email" class="alert alert-danger d-none"></div>
            <div id="alert-isi_pesan" class="alert alert-danger d-none"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- Swal JS for alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {
      // Handle form submission
      $('#formData').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('email', $('#email').val());
        formData.append('isi_pesan', $('#isi_pesan').val());

        $.ajax({
          url: '/api/pesans',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log('AJAX request succeeded:', response);

            Swal.fire({
              icon: 'success',
              title: 'Pesan berhasil dikirim',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              console.log('Swal callback triggered');

              $('#pesanModal').modal('hide');
              console.log('Modal hide called');

              $('#formData')[0].reset();
              $('#alert-email, #alert-isi_pesan').addClass('d-none');

              setTimeout(() => {
                console.log('Redirecting to dashboard');
                window.location.href = "/profilPengunjung";
              }, 500); // Delay to ensure modal is closed
            });
          },
          error: function (xhr) {
            var errors = xhr.responseJSON.errors;
            console.log('AJAX request failed:', errors);

            $('#alert-email').toggleClass('d-none', !errors.email).text(errors.email ? errors.email[0] : '');
            $('#alert-isi_pesan').toggleClass('d-none', !errors.isi_pesan).text(errors.isi_pesan ? errors.isi_pesan[0] : '');
          }
        });
      });
    });
  </script>



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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main2.js"></script>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

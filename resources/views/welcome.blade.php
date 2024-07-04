<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Presence Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap');

    body {
      font-family: "Comfortaa", sans-serif;
      font-optical-sizing: auto;
      font-style: normal;
    }

    :root {
      --bs-primary: #FF4081;
      /* Pink */
      --bs-secondary: #FFC107;
      /* Amber */
      --bs-success: #4CAF50;
      /* Green */
      --bs-info: #2196F3;
      /* Blue */
      --bs-warning: #FFEB3B;
      /* Yellow */
      --bs-danger: #F44336;
      /* Red */
      --bs-light: #F8F9FA;
      /* Light Gray */
      --bs-dark: #212529;
      /* Dark Gray */
      --bs-muted: #6C757D;
      /* Muted Gray */
      --bs-white: #FFFFFF;
      /* White */
      --bs-black: #000000;
      /* Black */
    }

    /* New Color Classes */
    .rose {
      color: #E91E63;
    }

    .bg-rose {
      background-color: #E91E63 !important;
    }

    .amber {
      color: #FFC107;
    }

    .bg-amber {
      background-color: #FFC107 !important;
    }

    .indigo {
      color: #3F51B5;
    }

    .bg-indigo {
      background-color: #3F51B5 !important;
    }

    .lime {
      color: #CDDC39;
    }

    .bg-lime {
      background-color: #CDDC39 !important;
    }
  </style>
</head>

<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <!-- Navigation-->
    <div class="container px-5">
      <nav class="navbar navbar-expand-lg navbar-light bg-white px-3 shadow mt-3 rounded-pill">
        <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">
            PA Jakarta Utara</span>
        </a>
        <button class="navbar-toggler btn-sm border-0" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
            <li class="nav-item"><a class="nav-link" target="_blank" href="https://pa-jakartautara.go.id"><ion-icon
                  color="primary" size="large" name="globe-outline"></ion-icon></a>
            </li>
            <li class="nav-item"><a class="nav-link" target="_blank"
                href="https://www.instagram.com/pa.jakartautara"><ion-icon color="primary" size="large"
                  name="logo-instagram"></a></li>
            <li class="nav-item"><a class="nav-link" target="_blank"
                href="https://www.facebook.com/pa.jakartautara/"><ion-icon color="primary" size="large"
                  name="logo-facebook"></a></li>
          </ul>
        </div>
    </div>
    </nav>
    <!-- Header-->
    <header class="py-5">
      <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center">
          <div class="col-xxl-5">
            <!-- Header text content-->
            <div class="text-center text-xxl-end ">
              <div class="fs-3 fw-light text-muted">Selamat Datang di Halaman Utama</div>
              <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline">Aplikasi Presensi Online</span>
              </h1>
              <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-end mb-3">
                <a class="btn bg-rose text-white btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder"
                  href="https://presensi.pajakartautara.id">
                  <ion-icon name="location"></ion-icon>
                  Presensi</a>
                <a class="btn btn-outline-primary btn-lg px-5 py-3 fs-6 fw-bolder" href="{{ url('admin') }}">Log In as
                  Admin</a>
              </div>
            </div>
          </div>
          <div class="col-xxl-7">
            <!-- Header profile picture-->
            <div class="d-flex justify-content-center mt-5 mt-xxl-0">
              <div class="profile bg-gradient-primary-to-secondary">
                <!-- TIP: For best results, use a photo with a transparent background like the demo example below-->
                <!-- Watch a tutorial on how to do this on YouTube (link)-->
                <img class="profile-img" src="img/attend.png" alt="..." style="width: 100%; height: auto;" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- About Section-->
    <section class="bg-light py-5">
      <div class="container px-5">
        <div class="row gx-5 justify-content-center">
          <div class="col-xxl-8">
            <div class="text-center my-5">
              <h2 class="display-5 fw-bolder">
                <span class="text-gradient d-inline">Fitur</span>
              </h2>
              <p class="lead fw-light mb-4">Aplikasi ini juga dilengkapi dengan fitur seperti berikut.</p>

              <div class="container">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                      <ion-icon style="font-size: 50px" name="notifications"></ion-icon>
                      <h3>Notifikasi</h3>
                      <p class="lead mb-0">Notifikasi menggunakan whatsapp!</p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                      <ion-icon style="font-size: 50px" name="location"></ion-icon>
                      <h3>Location</h3>
                      <p class="lead mb-0">Sistem Presensi menggunakan lokasi GPS!</p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                      <ion-icon style="font-size: 50px" name="shapes-outline"></ion-icon>
                      <h3>PWA</h3>
                      <p class="lead mb-0">Bisa di install dengan cepat tanpa perlu di download!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="py-5">
      <div class="container px-5 text-center">
        <div class="d-flex justify-content-center gap-2">
          <img width="300" src="{{ url('img/ss_presensi.png') }}" alt="Screen Shot Presensi Tab">
          <img width="300" src="{{ url('img/ss_aktivitas.png') }}" alt="Screen Shot Presensi Aktivity">
        </div>
      </div>
    </section>
  </main>
  <!-- Footer-->
  <footer class="bg-white py-4 mt-auto">
    <div class="container px-5">
      <div class="row align-items-center justify-content-between flex-column flex-sm-row">
        <div class="col-auto">
          <div class="small m-0">Copyright &copy; Pengadilan Agama Jakarta Utara 2023</div>
        </div>
        <div class="col-auto">
          Develop by :
          <a class="small" target="_blank" href="https://mmaliki.my.id">mmaliki.my.id</a>

        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>

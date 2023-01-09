<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>NovoTag</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="web/assets/img/logo.png" rel="icon">
  <link href="web/assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="web/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="web/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="web/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="web/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="web/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="web/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="web/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="web/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto">
        <a href="/">
            <i class="bi bi-car-front-fill"></i> NovoTag
        </a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Obten tu TAG</a></li>
          <li><a class="nav-link scrollto" href="#services">Devuelve tu TAG</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contacto</a></li>
          <li><a class="getstarted scrollto" href="{{ url('login') }}">Empresa</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>HABILITA TU TAG</h1>
          <h2>Puedes Solicitar tu TAG a domicilio de manera online de forma rápida y segura</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started scrollto">Obten tu Tag</a>
            <a href="#services" class="scrollto btn-watch-video"><i class="bi bi-arrow-repeat"></i><span>Devuelve tu Tag</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="web/assets/img/tag.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="web/assets/img/clients/vespucio_norte.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="web/assets/img/clients/costanera_norte.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="web/assets/img/clients/autopista_aconcagua.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="web/assets/img/clients/autopista_central.jpeg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="web/assets/img/clients/rutas_pacifico.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Obten tu TAG</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              En Simples pasos podras obtener tu a domicilio o tambien lo puedes retirar en nuestros locales habilitados
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> 1.- Debes llenar todos los datos solicitados</li>
              <li><i class="ri-check-double-line"></i> 2.- Recuerda tener los documentos de tu vehiculo al alcance, solo basta una fotografía legible</li>
              <li><i class="ri-check-double-line"></i> 3.- Puedes pagar con Debito o Credito</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 text-center">
            <p>
              A continuación elige el proceso a realizar.
            </p>
            <a href="{{ route('natural') }}" class="btn-learn-more"><i class="bi bi-person-bounding-box"></i> Solicita tu Tag como PERSONA NATURAL</a>
            <p></p>
            <a href="{{ route('empresa') }}" class="btn-learn-more"><i class="bi bi-buildings"></i> Solicita tu Tag como EMPRESA</a>
          </div>
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
              <img src="web/assets/img/skills.png" class="img-fluid" alt="">
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Devuelve tu Tag</h2>
          <p>Puedes realizar el procedimiento online en simples pasos. Recuerda tener la documentación de tu vehiculo al alcance.</p>
        </div>

        <div class="row justify-content-around">

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box text-center">
             
              <h1><i class="bi bi-person-bounding-box"></i></h1>
              <h4><a href="{{ route('tagdevolucion') }}">Proceso como Persona Natural</a></h4>

            </div>
          </div>

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box text-center">
              
              <h1><i class="bi bi-buildings"></i></h1>
              <h4><a href="{{ route('tagdevolucionempresa') }}">Proceso como Empresa</a></h4>
          
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Llamanos si Tienes Dudas</h3>
            <p>Si deseas tener mayor claridad del proceso no dudes en llamarnos. +32 3510086</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="tel:32 3510086">Activar Llamado</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row">

          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Casa Matriz:</h4>
                <p>13 Norte 853 - Oficina 803, Viña del Mar</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>contacto@novotag.cl</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+32 3510086  /  +569 94338937</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13383.397862876765!2d-71.545136!3d-33.007744!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9baa1aa6beb79f00!2sDecathlon%20Vi%C3%B1a%20del%20Mar!5e0!3m2!1ses!2scl!4v1673148591740!5m2!1ses!2scl" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>NovoTag</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        <span>Designed by  <a href="http://iscah.cl" >Iscah</a> 2023</span>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="web/assets/vendor/aos/aos.js"></script>
  <script src="web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="web/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="web/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="web/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="web/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="web/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="web/assets/js/main.js"></script>

</body>

</html>
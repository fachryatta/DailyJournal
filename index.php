<?php
include "koneksi.php"; 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arie's Journal</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <style>
      body, #hero, #gallery, #article, #schedule, #aboutme footer, .navbar .nav-link, footer a i {
      transition: background-color 0.5s ease, color 0.5s ease;
      }

      .dark-mode {
         background-color: #121212;
         color: #ffffff;
      }
   
      .dark-mode #hero,
      .dark-mode #gallery,
      .dark-mode #aboutme {
         background-color: #333 !important; 
         color: #ffffff !important;
      }
   

      .dark-mode #article,
      .dark-mode footer,
      .dark-mode #schedule {
         background-color: #ccc !important;
         color: #000 !important;
      }
   
      .dark-mode .navbar .nav-link {
         color: #000 !important; 
      }
   
      .dark-mode footer a i {
         color: #000 !important;
      }
   </style>  
  </head>
  <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
          <a class="navbar-brand" href="#">Arie's Journal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
              
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#article">Article</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#gallery">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#schedule">Schedule</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#aboutme">About Me</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php" target="_blank">Login</a>
              </li>
              <li class="nav-item">
                <button id="darkModeButton" class="btn btn-dark me-2">
                   <i class="bi bi-moon-fill"></i> Dark
                </button>
                <button id="lightModeButton" class="btn btn-light me-2">
                   <i class="bi bi-sun-fill"></i> Light
                </button>
             </li>              
            </ul>            
          </div>
        </div>
      </nav>
    <!-- nav end -->
    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-dark-subtle text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/banner.jpg" alt="" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-4">Don't Need To Talk, Just Walk the Walk!</h1>
                    <h4 class="lead display-6">"create memories with every step you take"</h4>
                    <h6>
                      <span id="tanggal"></span>
                      <span id="jam"></span>
                    </h6>
                </div>
            </div>
        </div>

    </section>
    <!-- hero end -->
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
    <!-- gallery begin  -->
    <section id="gallery" class="text-center p-5 bg-dark-subtle">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Gallery</h1>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1535982330050-f1c2fb79ff78?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y29sbGVnZXxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1511629091441-ee46146481b6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGNsYXNzfGVufDB8fDB8fHww" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGNvbGxlZ2V8ZW58MHx8MHx8fDA%3D" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1549057446-9f5c6ac91a04?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTAyfHxjb2xsZWdlfGVufDB8fDB8fHww" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8ODl8fGNvbGxlZ2V8ZW58MHx8MHx8fDA%3D" class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </section>
    <!-- gallery end  -->
    <!-- schedule begin -->
    <section id="schedule" class="text-center p-5">
      <div class="container">
          <h1 class="fw-bold display-4 pb-3">Schedule</h1>
          <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                      Senin
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Probablilitas dan Statistik <br> 12.30 - 15.00 | H.4.7</li>
                      <li class="list-group-item">Rekayasa Perangkat Lunak <br> 15.30 - 18.00 | H.4.6 </li>
                      <li class="list-group-item"> <br><br>  </li>
                    </ul>
                  </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                      Selasa
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Sistem Operasi <br> 09.30 - 12.00 | H.3.11 </li>
                      <li class="list-group-item">Logika Informatika <br> 15.30 - 18.00 | H.4.5</li>
                      <li class="list-group-item"> <br><br></li>
                    </ul>
                  </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                      Rabu
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Penambangan Data <br> 09.30 - 12.00 | H.4.9</li>
                      <li class="list-group-item">Basis Data <br> 14.10 - 15.50 | D.3.M</li>
                      <li class="list-group-item"> <br><br></li>
                    </ul>
                  </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                      Kamis
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Pemrograman Berbasis Web <br> 12.30 - 14.10 | D.2.J</li>
                      <li class="list-group-item">Kriptografi <br> 15.30 - 18.00 | H.4.11</li>
                      <li class="list-group-item"> <br><br></li>
                    </ul>
                  </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                      Jumat
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Basis Data (Teori) <br> 10.20 -12.00 | H.5.14</li>
                    </ul>
                  </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                      Sabtu
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">FREE <br><br></li>
                    </ul>
                  </div>
            </div>
          </div>
      </div>
    </section>
    <!-- schedule end -->
    <!-- aboutme begin -->
    <section id="aboutme" class="text-center p-5 bg-dark-subtle">
      <div class="container">
        <div class="d-sm-flex flex-sm-row align-items-center justify-content-center">
              <img src="https://menshaircuts.com/wp-content/uploads/2024/08/tp-boys-haircuts.jpg" alt="" width="300" height="300" class="rounded-circle" id="profilePic">    
          <div class="text-center text-md-start" style="padding: 30px" id="description">
            <h4 class="lead display-7">A11.2023.15170</h4>
            <h1>Arie Atta Margosa</h1>
            <h5 class="lead display-7">Program Studi Teknik Informatika</h5>
            <a href="https://dinus.ac.id/" style="color: black; text-decoration: none;" target="_blank">Universitas Dian Nuswantoro</a>
          </div>
          </div>
      </div>
    </section>
    <!-- aboutme end -->
    <!-- footer begin  -->
    <footer class="text-center p-5">
        <div>
            <a href="https://www.instagram.com/fachryyatta" target="_blank"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href="https://twitter.com/jeyonisme" target="_blank"><i class="bi bi-twitter-x h2 p-2 text-dark"></i></a>
            <a href="https://wa.me/+62895350766667" target="_blank"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div>
            Fachry Atta &copy; 2024
        </div>
    </footer>
    <!-- footer end -->
    
    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"
    ></script>
    
    <script type="text/javascript">
      tampilWaktu();
    
      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;
    
        setTimeout(tampilWaktu, 1000); 
        document.getElementById("tanggal").innerHTML =
          waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML =
          waktu.getHours() + ":" +
          waktu.getMinutes() + ":" +
          waktu.getSeconds();
      }
    </script>
    
    <script>
      const darkModeButton = document.getElementById('darkModeButton');
      const lightModeButton = document.getElementById('lightModeButton');

      if (localStorage.getItem('theme') === 'dark') {
      document.body.classList.add('dark-mode');
      }

      darkModeButton.addEventListener('click', () => {
      document.body.classList.add('dark-mode');
      localStorage.setItem('theme', 'dark');
      });

      lightModeButton.addEventListener('click', () => {
      document.body.classList.remove('dark-mode');
      localStorage.setItem('theme', 'light');
      });
   </script>

<script>
    const profilePic = document.getElementById('profilePic');
    const description = document.getElementById('description');

    description.style.display = 'none';

    profilePic.addEventListener('click', function() {
        if (description.style.display === 'none') {
            description.style.display = 'block';  // Tampilkan deskripsi
        } else {
            description.style.display = 'none';   // Sembunyikan deskripsi
        }
    });
</script>
   
  </body>
</html>
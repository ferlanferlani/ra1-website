<?php
require 'config.php';
?>



<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="<?= BASE_URL?>">Class ra 1 <span class="color-b">TI</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link " href="<?= BASE_URL?>">Beranda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?= BASE_URL?>tentang">Tentang</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?= BASE_URL ?>projects/">Project</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?= BASE_URL?>blog/">Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?= BASE_URL?>galeri">Galeri</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?= BASE_URL?>kontak">Kontak</a>
          </li>
        </ul>
      </div>
     <a href="<?= BASE_URL?>login" class="btn btn-b-n rounded mb-4">Masuk</a>
    </div>
  </nav><!-- End Header/Navbar -->
  
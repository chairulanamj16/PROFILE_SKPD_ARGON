   <header id="header" class="header d-flex align-items-center fixed-top">
       <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

           <a href="index.html" class="logo d-flex align-items-center">
               <!-- Uncomment the line below if you also wish to use an image logo -->
               @if ($office->logo)
                   <img src="{{ url('storage') . '/' . $office->logo }}" class="img-fluid" width="100" height="100"
                       alt="{{ $office->subdomain }}">
               @else
                   <img src="{{ url('') }}/assets/logo.png" alt="Kabupaten Tapin">
               @endif
               <h1 class="sitename text-uppercase">
                   {{ $office->subdomain }}
               </h1>
           </a>

           <nav id="navmenu" class="navmenu">
               <ul>
                   <li><a href="#hero" class="active">Beranda</a></li>
                   <li><a href="#PPID">PPID</a></li>
                   <li class="dropdown">
                       <a href="#"><span>Profil</span>
                           <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                       <ul>
                           <li><a href="#">Visi & Misi</a></li>
                           <li><a href="#">Sejarah Pembentukan</a></li>
                           <li><a href="#">Struktur Organisasi</a></li>
                           <li><a href="#">Profil Pegawai</a></li>
                       </ul>
                   </li>
                   <li class="dropdown">
                       <a href="#"><span>Informasi</span>
                           <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                       <ul>
                           <li><a href="#">Berita</a></li>
                           <li><a href="#">Kegiatan</a></li>
                           <li><a href="#">Pengumuman</a></li>
                           <li><a href="#">Video Galeri</a></li>
                       </ul>
                   </li>
                   <li><a href="#publikasi">Publikasi</a></li>
                   <li><a href="#hubungi_kami">Hubungi Kami</a></li>
               </ul>
               <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
           </nav>

       </div>
   </header>

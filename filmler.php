<!DOCTYPE html>
<?php
include('baglan.php');

// Genel Bilgiler
$sorgu_gnl = mysqli_query($conn, "SELECT * FROM genel_bilgiler");
$satir_gnl = mysqli_fetch_array($sorgu_gnl);

// Filmler Sorgusu
$sorgu_film = mysqli_query($conn, "SELECT * FROM filmler ORDER BY adi asc");
?>

<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?php echo $satir_gnl['site_adi'] ?></title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- font awesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

  <style>
    .img-box img {
      width: 100%;
      height: 500px;
      object-fit: cover;
      border-radius: 10px;
    }
    .film-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .film-item {
      margin-bottom: 20px;
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section starts --
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand mr-5" href="index.php">
            <img src="images/logo.png" alt="">
            <span>
              <?php //echo $satir_gnl['site_adi'] ?>
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Anasayfa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="hakkinda.php">Hakkımızda</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="filmler.php">Filmler</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="yonetmenler.php">Yönetmenler</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="oyuncular.php">Oyuncular</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="iletisim.php">İletişim</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="rapor.php">Rapor</a>
                </li>
              </ul>
              <form class="form-inline">
                <button class="btn my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    !-- end header section -->
  </div>

  <div class="body_bg layout_padding">
    <section class="furniture_section layout_padding">
      <div class="container">
        <div class="heading_container">
          <h2>Filmlerimiz</h2>
        </div>
        <form id='film_filtre'>
          <hr style="width:100%;text-align:center;margin-left:0">
          <?php 
          $sorgu_film_ilkharfler = mysqli_query($conn,"select substr(adi,1,1) as harf, count(id) as sayi 
                            from filmler group by substr(adi,1,1)");
          echo "<table width=100% border=0>";							
          while ( $satir_ilkharf = mysqli_fetch_array($sorgu_film_ilkharfler)) {
            $h_adi = $satir_ilkharf['harf'];
            echo "<td align=center>";
            echo "<input type='radio' id='film_harf_$h_adi' name='filtre_harf' value='$h_adi'> <label for='film_harf_$h_adi'> $h_adi</label> ";
            echo "</td>";
          }
          echo "</table>";
          ?>
          <hr style="width:100%;text-align:center;margin-left:0">

          <?php 
          $sorgu_film_kategoriler = mysqli_query($conn,"select C.id as k_id, C.adi as k_adi from filmler as B, kategoriler as C where B.kategori_id = C.id group by B.kategori_id order by C.adi");
          echo "<table width=100% border=0>";							
          while ( $satir_kategori = mysqli_fetch_array($sorgu_film_kategoriler)) {
            $k_adi = $satir_kategori['k_adi'];
            $k_id = $satir_kategori['k_id'];
            echo "<td align=center>";
            echo "<input type='checkbox' id='film_kategori_$k_id' name='filtre_kategori' value='$k_id'> <label for='film_kategori_$k_id'> $k_adi</label> ";
            echo "</td>";
          }
          echo "</table>";
          ?>		
          <hr style="width:100%;text-align:center;margin-left:0">
        </form>

        <div id="sonuc" class="film-container row">
          <?php while ($satir_film = mysqli_fetch_array($sorgu_film)) {
            $film_id = $satir_film['id'];
            $sorgu_resim = mysqli_query($conn, "SELECT * FROM resimler WHERE film_id = $film_id");
            $satir_resim = mysqli_fetch_array($sorgu_resim);
          ?>
            <div class="film-item col-md-4">
              <div class="box">
                <div class="img-box">
                  <a href="film_detay.php?film_id=<?php echo $film_id; ?>">
                    <img src="images/filmler/<?php echo $satir_resim['adi'] ?>" alt="<?php echo $satir_film['adi'] ?>">
                  </a>
                </div>
                <div class="detail-box text-center">
                  <h5><?php echo $satir_film['adi'] ?></h5>
                  <div class="price_box">
                    <h6 class="price_heading"><?php echo $satir_film['cikis_yili'] ?></h6>
                    <a href="film_detay.php?film_id=<?php echo $film_id; ?>">İncele</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </div>

  <!--<section class="container-fluid footer_section">
    <p>Copyright &copy; 2019 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
  </section>-->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('form#film_filtre').change(sonucAl);

    $('#aramaTablosu').DataTable({
      pageLength: 25,
      responsive: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json"
      }
    });
  });

  function sonucAl() {
    $('#sonuc').html("<center><img src='images/yukleniyor.svg'></center>");
    var formData = $('form#film_filtre').serialize();

    $.ajax({
      type: 'GET',
      url: 'islemler.php',
      data: formData + '&islem=film&r=' + Math.random(),
      success: function(sonuc) {
        $('#sonuc').html(sonuc);
      }
    });

    return false;
  }
</script>
</body>

</html>
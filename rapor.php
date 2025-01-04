<!DOCTYPE html>
<?php
	include('baglan.php');
	$sorgu_gnl = mysqli_query($conn,"SELECT * FROM genel_bilgiler");
	$satir_gnl = mysqli_fetch_array($sorgu_gnl);
?>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo $satir_gnl['site_adi']; ?></title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

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
      height: auto;
      object-fit: cover;
      border-radius: 10px;
    }

    .info_section .box {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .info_section .img-box {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #000;
      font-size: 16px;
    }

    .info_section .img-box img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    .info_section .img-box span {
      font-size: 16px;
    }

    .footer_contact {
      text-align: center;
      margin: 20px 0;
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats --
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
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="hakkinda.php"> Hakkımızda </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="filmler.php"> Filmler </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="yonetmenler.php"> Yönetmenler </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="oyuncular.php"> Oyuncular </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="iletisim.php">İletişim</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="rapor.php">Rapor</a>
                </li>
              </ul>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    !-- end header section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding long_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            
			<img src="images/database.png">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
			      <h2 class="main-heading ">
        <?php echo $satir_gnl['site_adi'] ?> Proje Raporu
      </h2>
      <p align=justify >
        Projede Front-End için hazır bir şablon kullanılarak film,yönetmen ve oyuncu yönetim sistemi planlanmıştır. 
		Kütüphane'de yer alan film bilgileri,yönetmen bilgileri ve oyuncu bilgileri kullanıcılara uygun biçimde gösterilmektedir.
    Proje veritabanı diyagramı yandaki resimde verilmiştir.
	  </p>
	  <p>
		Projenin yapımında kullanılan araçlar :
		<ul>
			<li>PHP, HTML5</li>			
			<li><a style='all:unset;color:blue;cursor:pointer;' target='_blank' href='https://www.free-css.com/free-css-templates/page290/fregg'>Free CSS - Fregg Free CSS Template</a></li>
			<li>MySql</li>
			<li>Jquery</li>
			<li>Ajax</li>
			<li><a style='all:unset;color:blue;cursor:pointer;' target='_blank' href='https://www.chartjs.org/'>ChartJs</a></li>
			<li><a style='all:unset;color:blue;cursor:pointer;' target='_blank' href='https://datatables.net/'>DataTables</a></li>
		</ul>
		</p>	
            
        
			
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- info section -->
  <section class="info_section layout_padding">
    <div class="footer_contact">
      <div class="heading_container">
        <h2>İletişime Geç</h2>
      </div>
      <div class="box">
      <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($satir_gnl['adres']); ?>" target="_blank" class="img-box">
      <img src="images/location.png" alt="Location Icon">
      <span><?php echo $satir_gnl['adres']; ?></span>
      </a>
        <a href="tel:<?php echo $satir_gnl['telefon']; ?>" class="img-box">
          <img src="images/call.png" alt="Call Icon">
          <span><?php echo $satir_gnl['telefon']; ?></span>
        </a>
        <a href="mailto:<?php echo $satir_gnl['e-mail']; ?>" class="img-box">
          <img src="images/envelope.png" alt="Email Icon">
          <span><?php echo $satir_gnl['e-mail']; ?></span>
        </a>
      </div>
    </div>
  </section>
  <!-- info section ends -->

  <!-- footer section --
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; 2019 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  !-- footer section ends -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

</html>

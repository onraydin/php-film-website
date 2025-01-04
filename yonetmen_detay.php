<?php
include('baglan.php');

// Genel Bilgiler
$sorgu_gnl = mysqli_query($conn, "SELECT * FROM genel_bilgiler");
$satir_gnl = mysqli_fetch_array($sorgu_gnl);

// Gelen yönetmen ID'sini alın
$yonetmen_id = isset($_GET['yonetmen_id']) ? (int)$_GET['yonetmen_id'] : 0;

// Yönetmen bilgilerini veritabanından çekin
$sorgu_yonetmen = mysqli_query($conn, "SELECT * FROM yonetmenler WHERE id = $yonetmen_id");
$satir_yonetmen = mysqli_fetch_array($sorgu_yonetmen);

// Eğer geçersiz bir ID verilmişse anasayfaya yönlendirin
if (!$satir_yonetmen) {
  header("Location: yonetmenler.php");
  exit;
}

// Yönetmenin yönettiği filmleri çekin ve her filme ait resimleri alın
$sorgu_filmler = mysqli_query($conn, "
  SELECT f.*, r.adi AS resim_adi
  FROM filmler AS f
  LEFT JOIN resimler AS r ON f.id = r.film_id
  WHERE f.yonetmen_id = $yonetmen_id
  ORDER BY f.cikis_yili DESC
");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?php echo $satir_gnl['site_adi']; ?></title>

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
  .film-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 10px;
  }
  .yonetmen-img {
    width: 75%;
    height: 350px;
    max-width: 300px;
    border-radius: 10px;
  }
  </style>
</head>
<body class="sub_page">
  <div class="hero_area">
  <!-- header section strats -->
  <header class="header_section">
    <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
      <a class="navbar-brand mr-5" href="index.php">
      <img src="images/logo.png" alt="">
      <span>
      <?php echo $satir_gnl['site_adi'] ?>
      </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
        <ul class="navbar-nav  ">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php?sayfa=hakkinda">Hakkında</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php?sayfa=filmler">Filmler</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php?sayfa=yönetmenler">Yönetmenler</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php?sayfa=oyuncular">Oyuncular</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php?sayfa=iletisim">İletişim</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php?sayfa=rapor">Rapor</a>
        </li>
        </ul>
        <div class="quote_btn-container">
        <a class="nav-link" href="anasayfa.php?sayfa=arama">
        <i class="fa fa-search" ></i>
        </a>
      </div>
      </div>
      </div>
    </nav>
    </div>
  </header>
  <!-- end header section -->
  </div>

  <div class="container mt-5">
  <h1><?php echo $satir_yonetmen['adi'] . " " . $satir_yonetmen['soyadi']; ?></h1>
  <div class="row">
    <div class="col-md-4">
    <img src="images/yönetmen/<?php echo $satir_yonetmen['resim']; ?>" class="yonetmen-img" alt="<?php echo $satir_yonetmen['adi']; ?>">
    </div>
    <div class="col-md-8">
    <p><strong>Biyografi:</strong> <?php echo nl2br($satir_yonetmen['ozgecmis']); ?></p>
    </div>
  </div>

  <!-- Yönetmenin Filmleri -->
  <h3 class="mt-5">Yönettiği Filmler</h3>
  <div class="row">
    <?php while ($film = mysqli_fetch_array($sorgu_filmler)): ?>
    <div class="col-md-4 mb-4">
      <div class="card">
      <?php if ($film['resim_adi']): ?>
        <img src="images/filmler/<?php echo $film['resim_adi']; ?>" class="card-img-top film-img" alt="<?php echo $film['adi']; ?>">
      <?php else: ?>
        <img src="images/default-film.png" class="card-img-top film-img" alt="Varsayılan Resim">
      <?php endif; ?>
      <div class="card-body">
        <h5 class="card-title"><?php echo $film['adi']; ?></h5>
        <p class="card-text"><?php echo mb_substr($film['tanitim'], 0, 100) . '...'; ?></p>
        <a href="film_detay.php?film_id=<?php echo $film['id']; ?>" class="btn btn-primary">Detaylar</a>
      </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <!-- Geri Dön Butonu -->
  <a href="anasayfa.php?sayfa=yönetmenler" class="btn btn-primary mt-3">Geri Dön</a>
  </div>

  <section class="container-fluid footer_section">
  <p>Copyright &copy; 2019 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
  </section>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

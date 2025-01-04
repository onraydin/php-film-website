<?php
include('baglan.php');

// Genel Bilgiler
$sorgu_gnl = mysqli_query($conn, "SELECT * FROM genel_bilgiler");
$satir_gnl = mysqli_fetch_array($sorgu_gnl);

// Gelen film ID'sini alın
$film_id = isset($_GET['film_id']) ? (int)$_GET['film_id'] : 0;

// Film bilgilerini veritabanından çekin
$sorgu_film = mysqli_query($conn, "SELECT * FROM filmler WHERE id = $film_id");
$satir_film = mysqli_fetch_array($sorgu_film);

// Eğer geçersiz bir ID verilmişse anasayfaya yönlendirin
if (!$satir_film) {
  header("Location: filmler.php");
  exit;
}

$yonetmen_id = $satir_film['yonetmen_id'];
$sorgu_yonetmen = mysqli_query($conn,"SELECT * FROM yonetmenler WHERE id = $yonetmen_id");
$satir_yonetmen = mysqli_fetch_array($sorgu_yonetmen);

$kategori_id = $satir_film['kategori_id'];
$sorgu_kategori = mysqli_query($conn,"SELECT * FROM kategoriler WHERE id = $kategori_id");
$satir_kategori = mysqli_fetch_array($sorgu_kategori);

$yayin_dili = $satir_film['yayin_dili'];
$sorgu_dil = mysqli_query($conn,"SELECT * FROM diller WHERE id = $yayin_dili");
$satir_dil = mysqli_fetch_array($sorgu_dil);

// Filmle ilgili resimleri çekin
$sorgu_resim = mysqli_query($conn, "SELECT * FROM resimler WHERE film_id = $film_id");

// YouTube URL'sinden Video ID'sini alma fonksiyonu
function getYoutubeVideoId($url) {
  parse_str(parse_url($url, PHP_URL_QUERY), $vars);
  return $vars['v'] ?? '';
}

$youtube_id = getYoutubeVideoId($satir_film['youtube_url']);

// Filmdeki oyuncu ID'lerini film_oyuncu tablosundan alıyoruz
$oyuncular_listesi = [];
$sorgu_oyuncular = mysqli_query($conn, "SELECT o.adi, o.soyadi FROM oyuncular o INNER JOIN film_oyuncu fo ON o.id = fo.oyuncu_id WHERE fo.film_id = $film_id");
while ($satir_oyuncu = mysqli_fetch_array($sorgu_oyuncular)) {
  $oyuncular_listesi[] = $satir_oyuncu['adi'] . " " . $satir_oyuncu['soyadi'];
}
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
  .img-box img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 10px;
  }

  iframe {
    width: 100%;
    height: 400px;
    border-radius: 10px;
    border: none;
  }

  .row {
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .actors-list ul {
    list-style-type: none;
    padding-left: 0;
  }

  .actors-list li {
    margin-bottom: 10px;
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
  <h1><?php echo $satir_film['adi']; ?></h1>
  <p><strong>Film Dakika:</strong> <?php echo $satir_film['film_dakika']; ?> Dakika</p>
  <p><strong>Kategori:</strong> <?php echo $satir_kategori['adi']; ?></p>
  <p><strong>Çıkış Yılı:</strong> <?php echo $satir_film['cikis_yili']; ?></p>
  <p><strong>Yönetmen:</strong> <a href="yonetmen_detay.php?yonetmen_id=<?php echo $satir_yonetmen['id']; ?>">
    <?php echo $satir_yonetmen['adi'] . " " . $satir_yonetmen['soyadi']; ?></a>
  </p>
  <p><strong>Oyuncular:</strong>
  <?php if (!empty($oyuncular_listesi)): ?>
      <?php echo implode(', ', $oyuncular_listesi); ?>
    <?php else: ?>
    <p> Bu filmde oyuncu bulunmamaktadır.</p>
    <?php endif; ?>
  </p>
    <!-- Oyuncular Listesi -->
    <div class="actors-list mt-4">
    
    
  </div>
  <p><strong>Özet:</strong> <?php echo $satir_film['tanitim']; ?></p>
  <p><strong>Yayımlanma Dili:</strong> <?php echo $satir_dil['adi']; ?></p>
  
  <!-- Film Resimleri ve YouTube Video -->
  <div class="row">
    <div class="col-md-4">
    <?php while ($satir_resim = mysqli_fetch_array($sorgu_resim)) { ?>
      <img src="images/filmler/<?php echo $satir_resim['adi']; ?>" class="img-fluid mb-3" alt="<?php echo $satir_film['adi']; ?>">
    <?php } ?>
    </div>
    <div class="col-md-8">
    <?php if ($youtube_id): ?>
      <iframe src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" allowfullscreen></iframe>
    <?php else: ?>
      <p>YouTube videosu bulunamadı.</p>
    <?php endif; ?>
    </div>
  </div>



  <!-- Geri Dön Butonu -->
  <a href="anasayfa.php?sayfa=filmler" class="btn btn-primary mt-3">Geri Dön</a>
  </div>

  <section class="container-fluid footer_section">
  <p>Copyright &copy; 2019 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
  </section>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

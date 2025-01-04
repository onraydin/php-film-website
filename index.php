<!DOCTYPE html>
<?php
  include('baglan.php');
  $sorgu_gnl = mysqli_query($conn,"Select * from genel_bilgiler");
  $satir_gnl = mysqli_fetch_array($sorgu_gnl);
?>
<html lang="tr">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo $satir_gnl['site_adi'] ?></title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />


  <!-- font wesome stylesheet -->
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

<body>
    <!-- Grafik 1 -->		
<?php
  $say_yonetmen_bay = mysqli_num_rows(mysqli_query($conn,"select * from yonetmenler where cinsiyet='E'"));
  $say_yonetmen_bayan = mysqli_num_rows(mysqli_query($conn,"select * from yonetmenler where cinsiyet='K'"));	
?>	

<!-- Grafik 2 -->

<?php
 $sorgu_kategori = mysqli_query($conn,"select count(B.id) as sayi, C.id as f_id, C.adi as f_adi  from filmler as B, kategoriler as C where  B.kategori_id = C.id group by B.kategori_id order by C.adi"); 
 $dizi_kategori_adi = array();
 $dizi_kategori_film_sayisi = array();
 
 while ( $satir_kategori = mysqli_fetch_array($sorgu_kategori)) {  
  $dizi_kategori_adi[] = $satir_kategori['f_adi'];
  $dizi_kategori_film_sayisi[] = $satir_kategori['sayi'];
}

$toplam_film_sayisi = array_sum($dizi_kategori_film_sayisi);
?>

<!-- Grafik 3 -->

<?php
 $sorgu_yonetmen = mysqli_query($conn,"select count(K.id) as sayi, Y.id as y_id, Y.adi as y_adi, Y.soyadi as y_soyadi  from filmler as K, yonetmenler as Y where K.yonetmen_id = Y.id group by K.yonetmen_id order by sayi desc limit 5"); 
 $dizi_yonetmen_adi = array();
 $dizi_yonetmen_film_sayisi = array();
 
 while ( $satir_yonetmen = mysqli_fetch_array($sorgu_yonetmen)) {  
  $dizi_yonetmen_adi[] = $satir_yonetmen['y_adi']." ".$satir_yonetmen['y_soyadi'];
  $dizi_yonetmen_film_sayisi[] = $satir_yonetmen['sayi'];
}

$toplam_film_sayisi = array_sum($dizi_kategori_film_sayisi);
?>
<!-- Grafik 4 -->
<?php
  $say_oyuncu_bay = mysqli_num_rows(mysqli_query($conn,"select * from oyuncular where cinsiyet='E'"));
  $say_oyuncu_bayan = mysqli_num_rows(mysqli_query($conn,"select * from oyuncular where cinsiyet='K'"));
?>
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
   
  <!-- slider section -->
    <section class="slider_section position-relative">
      <div class="container">
      <div class="row">
        <div class="col-md-7">
        <div class="detail-box">
          <div>
          <h1>
            Sahne Keyfi'ne <br>
            <span>
            Hoşgeldiniz...
            </span>
          </h1>
          <p>
            <?php echo $satir_gnl['kisa_bilgi'] ?>
          </p>
          <div class="btn-box">
            <a href="anasayfa.php?sayfa=filmler" class="btn-1">
            Hadi Göz Atalım
            </a>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <div class="body_bg layout_padding">

  <!-- service section -->
  <section class="service_section long_section">
    <div id="customCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active">
    <div class="container ">
    <div class="row">
    <div class="col-md-5">
    <div class="detail-box">
    <h1>
    Toplam Yönetmen Sayısı
    </h1>
    <p>
    Kütüphanemizde filmi bulunan toplam <strong><?php echo $say_yonetmen_bay+$say_yonetmen_bayan; ?> </strong> adet yönetmenin cinsiyetlerine göre dağılımı yandaki grafikte verilmiştir.
    </p>
    </div>
    </div>
    <div class="col-md-7">
    <div class="img-box">
    <div style='width:400px;height:400px;margin-bottom:50px'><canvas id="grafik1"></canvas></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="carousel-item">
    <div class="container ">
    <div class="row">
    <div class="col-md-5">
    <div class="detail-box">
    <h1>
    Toplam Oyuncu Sayısı
    </h1>
    <p>
    Kütüphanemizde filmi bulunan toplam <strong><?php echo $say_oyuncu_bay+$say_oyuncu_bayan; ?> </strong> adet oyuncunun cinsiyetlerine göre dağılımı yandaki grafikte verilmiştir.
    </p>
    </div>
    </div>
    <div class="col-md-7">
    <div class="img-box">
    <div style='width:400px;height:400px;margin-bottom:50px'><canvas id="grafik4"></canvas></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="carousel-item">
    <div class="container ">
    <div class="row">
    <div class="col-md-5">
    <div class="detail-box">
    <h1>
    KATEGORİLERİNE GÖRE <br>
    FİLMLER
    </h1>
    <p>
    Kütüphanemizde bulunan toplam <strong> <?php echo $toplam_film_sayisi; ?> </strong> adet filmin kategorilerine göre dağılımı yandaki grafikte verilmiştir.
    </p>
    </div>
    </div>
    <div class="col-md-7">
    <div class="img-box">
    <div style='width:400px;height:400px;margin-bottom:50px'><canvas id="grafik2"></canvas></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="carousel-item">
    <div class="container ">
    <div class="row">
    <div class="col-md-5">
    <div class="detail-box">
    <h1>
    EN ÇOK <br>
    FİLMİ OLANLAR
    </h1>
    <p>
    Kütüphanemizde en çok filmi bulunan 5 yönetmenin, film sayılarına göre dağılımı yandaki grafikte verilmiştir.
    </p>
    <div class="btn-box">
    
    </div>
    </div>
    </div>
    <div class="col-md-7">
    <div class="img-box">
    <div style='width:400px;height:400px;margin-bottom:50px'><canvas id="grafik3"></canvas></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <ol class="carousel-indicators">
    <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#customCarousel" data-slide-to="1"></li>
    <li data-target="#customCarousel" data-slide-to="2"></li>
    <li data-target="#customCarousel" data-slide-to="3"></li>
    </ol>
    </div>
  </section>
  <!-- end service section -->

  </div>
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

  <!-- footer section -->
  <section class="container-fluid footer_section">
  <p>
    Copyright &copy; 2019 All Rights Reserved By
    <a href="https://html.design/">Free Html Templates</a>
  </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  function loadPage(page) {
    $.ajax({
    url: page + '.php',
    success: function(data) {
      $('#content').html(data);
      window.history.pushState("", "", page);
    }
    });
  }

  $(document).ready(function() {
    $("#iletisim_formu").submit(function(e) {
      e.preventDefault(); // formun submit etmesini engellemek için kullanıyoruz
      var form = $(this);
      var actionUrl = form.attr('action');
      
      $.ajax({
          type: "GET",
          url: actionUrl,
          data: form.serialize() + '&islem=iletisim', 
          success: function(data) {
            $('#iletisim_formu').hide();
            $('#sonuc').html(data);
          }
      });
    });
  });

  // Grafik 1
  var ctx1 = document.getElementById('grafik1').getContext('2d');
  var grafik1 = new Chart(ctx1, {
    type: 'pie',
    data: {
      labels: ['Erkek', 'Kadın'],
      datasets: [{
        label: 'Yönetmen Cinsiyet Dağılımı',
        data: [<?php echo $say_yonetmen_bay; ?>, <?php echo $say_yonetmen_bayan; ?>],
        backgroundColor: ['#36A2EB', '#FF6384']
      }]
    }
  });
  // Grafik 4
  var ctx4 = document.getElementById('grafik4').getContext('2d');
  var grafik4 = new Chart(ctx4, {
    type: 'pie',
    data: {
      labels: ['Erkek', 'Kadın'],
      datasets: [{
        label: 'Oyuncular Cinsiyet Dağılımı',
        data: [<?php echo $say_oyuncu_bay; ?>, <?php echo $say_oyuncu_bayan; ?>],
        backgroundColor: ['#36A2EB', '#FF6384']
      }]
    }
  });
  // Grafik 2
  var ctx2 = document.getElementById('grafik2').getContext('2d');
  var grafik2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($dizi_kategori_adi); ?>,
      datasets: [{
        label: 'Film Sayısı',
        data: <?php echo json_encode($dizi_kategori_film_sayisi); ?>,
        backgroundColor: '#36A2EB'
      }]
    }
  });

  // Grafik 3
  var ctx3 = document.getElementById('grafik3').getContext('2d');
  var grafik3 = new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($dizi_yonetmen_adi); ?>,
      datasets: [{
        label: 'Film Sayısı',
        data: <?php echo json_encode($dizi_yonetmen_film_sayisi); ?>,
        backgroundColor: '#FF6384'
      }]
    }
  });
  </script>
</body>

</html>
